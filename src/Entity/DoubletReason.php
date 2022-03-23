<?php

namespace App\Entity;

class DoubletReason
{
    private $rulingElaboration;
    private $ruleCode;
    private $additional;

    public function getRulingElaboration(): string
    {
        return $this->rulingElaboration;
    }

    public function setRulingElaboration(string $rulingElaboration): self
    {
        $this->rulingElaboration = $rulingElaboration;

        return $this;
    }

    public function getRuleCode(): int
    {
        return $this->ruleCode;
    }

    public function setRuleCode(int $ruleCode): self
    {
        $this->ruleCode = $ruleCode;

        return $this;
    }

    public function getAdditional(): ?string
    {
        return $this->additional;
    }

    public function setAdditional(?string $additional): self
    {
        $this->additional = $additional;

        return $this;
    }

    public function __construct(string $rulingElaboration, int $ruleCode)
    {
        $this->rulingElaboration = $rulingElaboration;
        $this->ruleCode = $ruleCode;
    }
}
