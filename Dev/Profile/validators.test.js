const {
  validateEmail,
  validateUsername,
  validateName,
  validatePassword,
  validateSecurityAns,
} = require('./validators');

describe('Email validation', () => {
  it('should accept valid email addresses', () => {
    expect(validateEmail('john.doe@example.com')).toBe(true);
    expect(validateEmail('jane_doe@example.co.uk')).toBe(true);
    expect(validateEmail('johndoe@example.io')).toBe(true);
  });

  it('should reject invalid email addresses', () => {
    expect(validateEmail('john.doe@example')).toBe(false);
    expect(validateEmail('john.doe@.com')).toBe(false);
    expect(validateEmail('john.doe@com')).toBe(false);
  });
});

describe('Username validation', () => {
  it('should accept valid usernames', () => {
    expect(validateUsername('johndoe')).toBe(true);
    expect(validateUsername('johndoe123')).toBe(true);
    expect(validateUsername('JohnDoe')).toBe(true);
  });

  it('should reject invalid usernames', () => {
    expect(validateUsername('john_doe!')).toBe(false);
    expect(validateUsername('john.doe')).toBe(false);
    expect(validateUsername('john doe')).toBe(false);
  });
});

describe('Name validation', () => {
  it('should accept valid names', () => {
    expect(validateName('John')).toBe(true);
    expect(validateName('Jane')).toBe(true);
    expect(validateName('JohnPaul')).toBe(true);
  });

  it('should reject invalid names', () => {
    expect(validateName('John$')).toBe(false);
    expect(validateName('Jane_Doe')).toBe(false);
    expect(validateName('John@Doe')).toBe(false);
  });
});

describe('Password validation', () => {
  it('should accept valid passwords', () => {
    expect(validatePassword('Abcde123!')).toBe(true);
    expect(validatePassword('$tr0ngP@55w0rd')).toBe(true);
    expect(validatePassword('P@55word123')).toBe(true);
  });

  it('should reject invalid passwords', () => {
    expect(validatePassword('Password')).toBe(false);
    expect(validatePassword('password123')).toBe(false);
    expect(validatePassword('password!')).toBe(false);
  });
});

describe('Security Answer validation', () => {
  it('should accept valid security answers', () => {
    expect(validateSecurityAns('My first pet')).toBe(true);
    expect(validateSecurityAns('New York')).toBe(true);
    expect(validateSecurityAns('123456')).toBe(true);
  });

  it('should reject invalid security answers', () => {
    expect(validateSecurityAns('')).toBe(false);
  });
});
