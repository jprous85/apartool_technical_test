<?php


namespace Src\Domain\ValueObjects\CategoryVO;


final class CategoryExtId
{
    private $text;
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function __invoke(): string
    {
        return $this->text;
    }
}
