import {
  Controller,
  Post,
  Get,
  Put,
  Delete,
  Param,
  Body,
  UsePipes,
  ValidationPipe,
} from '@nestjs/common';
import { TasksService } from './task.service';
import { CreateTaskDto } from './dto/create-task.dto';

@Controller('tasks')
export class TaskController {
  constructor(private readonly taskService: TasksService) {}

  @Post()
  @UsePipes(new ValidationPipe({ whitelist: true }))
  create(@Body() dto: CreateTaskDto) {
    return this.taskService.create(dto);
  }

  @Get()
  findAll() {
    return this.taskService.findAll();
  }

  @Get(':id')
  findOne(@Param('id') id: number) {
    return this.taskService.findOne(+id);
  }

  @Put(':id')
  update(@Param('id') id: number, @Body() dto: Partial<CreateTaskDto>) {
    return this.taskService.update(+id, dto);
  }

  @Delete(':id')
  remove(@Param('id') id: number) {
    return this.taskService.remove(+id);
  }

  // ✅ NEW: Clear All Tasks
  @Delete()
  removeAll() {
    return this.taskService.removeAll();
  }
}