import { IsEmail, IsString, MinLength, Length, Matches } from 'class-validator';

export class CreateUserDto {
  @IsString({ message: 'ឈ្មោះត្រូវតែជាអក្សរតែប៉ុណ្ណោះ!' })
  @MinLength(3, { message: 'ឈ្មោះត្រូវមានយ៉ាងហោចណាស់ 3 តួអក្សរ!' })
  @Matches(/^[a-zA-Z0-9]+$/, {
    message: 'ឈ្មោះមិនអាចមានអក្សរពិសេស!',
  })
  username: string;

  @IsEmail({}, { message: 'អ៊ីមែលត្រូវត្រឹមត្រូវ!' })
  @Matches(/^[\w.%+-]+@(gmail\.com|[\w.-]+\.edu\.kh)$/, {
    message: 'អ៊ីមែលត្រូវស្ថិតនៅក្នុង gmail.com ឬ .edu.kh!',
  })
  email: string;

  @IsString({ message: 'ពាក្យសម្ងាត់ត្រូវតែជអក្សរ!' })
  @Length(6, 10, {
    message: 'ពាក្យសម្ងាត់ត្រូវមានប្រវែង 6-10 តួអក្សរ!',
  })
  @Matches(/^(?=.*[!@#$%^&*])/, {
    message: 'ពាក្យសម្ងាត់ត្រូវមានអក្សរពិសេស!',
  })
  password: string;
}