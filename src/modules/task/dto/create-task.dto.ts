import {
  IsNotEmpty,
  IsOptional,
  IsString,
  IsNumber,
  MinLength,
} from 'class-validator';

export class CreateTaskDto {
  @IsNotEmpty({ message: 'Task name is required.' })
  @IsString({ message: 'Task name must be a string.' })
  @MinLength(3, { message: 'Task name must be at least 3 characters long.' })
  name: string;

  @IsOptional()
  @IsString({ message: 'Description must be a string.' })
  description?: string;

  @IsNotEmpty({ message: 'User ID is required.' })
  @IsNumber({}, { message: 'User ID must be a number.' })
  userId: number;
}