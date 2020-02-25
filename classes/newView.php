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


}