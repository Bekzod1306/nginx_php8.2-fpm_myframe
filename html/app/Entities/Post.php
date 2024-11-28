<?php

namespace App\Entities;

use DateTimeImmutable;

class Post
{
    public function __construct(
        private ?int $id,
        private string $title,
        private string $body,
        private DateTimeImmutable|null $createdAt,
    ) {}
    public static function create(
        string $title,
        string $body,
        ?int $id = null,
        DateTimeImmutable|null $createdAt = null,
    ) {
        return new static($id, $title, $body, $createdAt??new DateTimeImmutable());
    }
    public function setId($id) {
        $this->id=$id;
    }
    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getBody() {
        return $this->body;
    }
    public function getCreatedAt() {
        return $this->createdAt;
    }
}
