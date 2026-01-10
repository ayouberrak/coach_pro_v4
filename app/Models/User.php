<?php
namespace App\Models;

class User {
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $passwordHash;
    private int $role;

    public function __construct(int $id , string $firstName, string $lastName, string $email, string $passwordHash, int $role) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->role = $role;
    }
    public function getId(): int {
        return $this->id;
    }
    public function getFirstName(): string {
        return $this->firstName;
    }
    public function getLastName(): string {
        return $this->lastName;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function getPasswordHash(): string {
        return $this->passwordHash;
    }
    public function getRole(): int {
        return $this->role;
    }
    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }
    public function setLastName(string $lastName): void {
        $this->lastName = $lastName;
    }
    public function setEmail(string $email): void {
        $this->email = $email;
    }
    public function setPasswordHash(string $passwordHash): void {
        $this->passwordHash = $passwordHash;
    }
    public function setRole(int $role): void {
        $this->role = $role;
    }
    
}
