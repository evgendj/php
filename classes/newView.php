<?php
namespace Test3;

class newView extends newBase
{
    private $type = null;
    private $size = 0;
    private $property = null;

    public function setValue($value)
    {
        parent::setValue($value);
        $this->setType();
        $this->setSize();
    }

    public function setProperty($value)
        {
            $this->property = $value;
            return $this;
        }

    private function setType()
    {
        $this->type = gettype($this->value);
    }

    private function setSize()
    {
        if (is_subclass_of($this->value, 'Test3\newView')) {
            $this->size = parent::getSize() + 1 + strlen($this->property);
        } elseif ($this->type == 'test') {
            $this->size = parent::getSize();
        } else {
            $this->size = strlen($this->value);
        }
    }

    public function __sleep()
    {
        return ['property'];
    }

    public function getName(): string
    {
        if (empty($this->name)) {
            throw new \Exception('The object doesn\'t have name'); // Поставил обратный слэш перед исключением
        }
        return '"' . $this->name  . '": ';
    }

    public function getType(): string
    {
        return ' type ' . $this->type  . ';';
    }

    public function getSize(): string
    {
        return ' size ' . $this->size . ';';
    }
    public function getInfo()
    {
        try {
            echo $this->getName()
                . $this->getType()
                . $this->getSize()
                . "\r\n";
        } catch (Exception $exc) {
            echo 'Error: ' . $exc->getMessage();
        }
    }


}
