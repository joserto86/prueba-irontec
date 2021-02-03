<?php 

namespace App\Model;

class ResultResponse
{
    /**
     * @var bool
     */
    private $success;

    /**
     * @var array
     */
    private $messages;

    public function setSuccess(bool $success) :self
    {
        $this->success = $success;
        return $this;
    }

    public function isSuccess() :bool
    {
        return $this->success;
    }

    public function setMessages(array $messages) :self
    {
        $this->messages = $messages;
        return $this;
    }

    public function getMessages() :array
    {
        return $this->messages;
    }

    public function addMessage(string $message) :self
    {
        $this->messages[] = $message;
        return $this;
    }
}