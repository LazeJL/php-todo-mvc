<?php

class TaskEntity{

    private int $id;
    private String $title;
    private String $description;
    private Bool $completed;
    private String $createdAt;
    private String $uptatedAt;
    private String $CompletedAt;

    function getId() : int {
        return $this->id;
    }

    function setId(int $id) : TaskEntity{
        $this->id = $id; 
        return $this;
    }

    function getTitle() : String {
        return $this->title;
    }

    function setTitle(String $title) : TaskEntity{
        $this->title = $title;
        return $this;
    }

    function getDescription() : String {
        return $this->description;
    }

    function setDescription(String $description) : TaskEntity {
        $this->description = $description;
        return $this;
    }

    function isCompleted() : Bool {
        return $this->completed;
    }

    function setCompleted(Bool $completed) : TaskEntity {
        $this->completed = $completed;
        return $this;
    }

    function getCreatedAt() : String {
        return $this->createdAt;
    }

    function setCreatedAt(String $createdAt) : TaskEntity {
        $this->createdAt = $createdAt;
        return $this;
    }

    function getUpdatedAt() : String {
        return $this->updatedAt;
    }

    function setUpdatedAt(String $updatedAt) : TaskEntity {
        $this->updatedAt = $updatedAt;
        return $this;
    }
} 