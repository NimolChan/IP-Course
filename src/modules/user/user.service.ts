import { Injectable, NotFoundException } from '@nestjs/common'; // ✅ Added NotFoundException
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { User } from './user.entity';
import { CreateUserDto } from './dto/create-user.dto';

@Injectable()
export class UserService {
  constructor(
    @InjectRepository(User)
    private readonly usersRepo: Repository<User>,
  ) {}

  async create(userData: CreateUserDto): Promise<User> {
    try {
      const user = this.usersRepo.create(userData);
      return await this.usersRepo.save(user);
    } catch (err: unknown) {
      if (err instanceof Error) {
        console.error('User save failed:', err.message);
      } else {
        console.error('Unknown error saving user:', err);
      }
      throw err;
    }
  }

  findAll(): Promise<User[]> {
    return this.usersRepo.find({ relations: ['tasks'] });
  }

  async findOne(id: number): Promise<User> {
    // ✅ Throw exception if not found
    const user = await this.usersRepo.findOne({
      where: { id },
      relations: ['tasks'],
    });
    if (!user) {
      throw new NotFoundException(`User with ID ${id} not found`);
    }
    return user;
  }

  async update(id: number, updateData: Partial<User>): Promise<User> {
    // ✅ Ensure user exists before updating
    const user = await this.findOne(id);
    Object.assign(user, updateData);
    return this.usersRepo.save(user);
  }

  async remove(id: number): Promise<void> {
    // ✅ Ensure user exists before deleting
    const user = await this.findOne(id);
    await this.usersRepo.remove(user);
  }
}