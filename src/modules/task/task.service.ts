// src/modules/task/task.service.ts
import {
  Injectable,
  NotFoundException,
  InternalServerErrorException,
} from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { Task } from './task.entity';
import { User } from '../user/user.entity';
import { CreateTaskDto } from './dto/create-task.dto';

@Injectable()
export class TasksService {
  constructor(
    @InjectRepository(Task)
    private taskRepo: Repository<Task>,

    @InjectRepository(User)
    private userRepo: Repository<User>,
  ) {}

  async create(taskData: CreateTaskDto): Promise<Task> {
    const user = await this.userRepo.findOne({
      where: { id: taskData.userId },
    });
// throw exception if user not found
    if (!user) {
      console.error(
        `❌ Task creation failed: User with ID ${taskData.userId} not found`
      );
      throw new NotFoundException(`User with ID ${taskData.userId} not found`);
    }
// Finds a specific task by id.
    const task = this.taskRepo.create({
      name: taskData.name,
      description: taskData.description,
      completedAt: null,
      user,
    });

    try {
      const savedTask = await this.taskRepo.save(task);
      console.log('✅ Task saved to DB:', savedTask);
      return savedTask;
    } catch (error) {
      console.error('❌ Error saving task:', error);
      throw new InternalServerErrorException('Failed to save task');
    }
  }

  async findAll(): Promise<Task[]> {
    return this.taskRepo.find({ relations: ['user'] });
  }

  async findOne(id: number): Promise<Task> {
    const task = await this.taskRepo.findOne({
      where: { id },
      relations: ['user'],
    });

    if (!task) {
      throw new NotFoundException(`Task with ID ${id} not found`);
    }

    return task;
  }

  async update(id: number, updateData: Partial<Task>): Promise<Task> {
    const task = await this.findOne(id);
    Object.assign(task, updateData);

    try {
      return await this.taskRepo.save(task);
    } catch (error) {
      console.error('❌ Error updating task:', error);
      throw new InternalServerErrorException('Failed to update task');
    }
  }

  async remove(id: number): Promise<void> {
    const task = await this.findOne(id);

    try {
      await this.taskRepo.remove(task);
    } catch (error) {
      console.error('❌ Error deleting task:', error);
      throw new InternalServerErrorException('Failed to delete task');
    }
  }

  // ✅ Added method for Clear All
  async removeAll(): Promise<void> {
    try {
      await this.taskRepo.clear();
      console.log('🧹 All tasks cleared from the database');
    } catch (error) {
      console.error('❌ Error clearing all tasks:', error);
      throw new InternalServerErrorException('Failed to clear all tasks');
    }
  }
}