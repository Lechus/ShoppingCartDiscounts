<?php namespace LPP\Shopping\View;


class View implements ViewInterface
{

    protected $fields = array();

    public function __construct(array $fields = array())
    {
        $this->fields = $fields;
    }

    public function setData(array $fields = array())
    {
        $this->fields = $fields;
    }

    private function generateSummary()
    {
        //extract($this->fields);

        $output = "";
        $quantityPad = 10;
        $namePad = 2;

        $maxLength = $this->fields['maxLength'];
        foreach ($this->fields['items'] as $item) {
            $output .= str_pad($item['quantity'], $quantityPad);
            $output .= str_pad($item['product']->getName(), $maxLength + $namePad);
            $output .= '£' . number_format($item['totalPrice'], 2);
            $output .= PHP_EOL;
        }
        $output .= str_pad('-', $quantityPad + $maxLength + $namePad, "-") . PHP_EOL;
        $output .= str_pad('Total:', $quantityPad + $maxLength + $namePad) . '£' . number_format(
                $this->fields['total'],
                2
            );
        return $output;
    }


    /**
     * @return string
     */
    public function render()
    {
        ob_start();

        echo $this->generateSummary();

        $renderedView = ob_get_clean();

        return $renderedView;
    }
}