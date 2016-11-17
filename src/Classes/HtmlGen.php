<?php
namespace Webtech;
class HtmlGen {
    public function __construct() {
        $this->open = '';  // Opening HTML generated so far
        $this->close = ''; // Closing HTML generated so far
        $this->escape_attributes = false;
        $this->escape_html = false;
    }

    public function __call($name, $args) {
        // Describes the HTML element we should render
        $element = array(
            'name' => $name,
            'attributes' => array(),
            'inner_html' => null,
            'render_options' => array()
        );

        // Work out what action to take based on function name
        if (preg_match('/^(.*)_(open|close|short|list)$/', $name, $matches)) {
            $action = $matches[2];
            $element['name'] = $matches[1];
        }
        else {
            $action = 'default';
        }

        $h = clone($this);

        // Generate an element for each argument passed to this function
        if ($action == 'list') {
            // Copy this object, but clear HTML generated so far
            $h2 = clone($this);
            $h2->open = '';
            $h2->close = '';
            $fname = $element['name'];
            
            // Work out which of the arguments is an array, if any, this
            // will contain the attributes
            $attributes = null;
            foreach ($args as $arg) {
                if (is_array($arg)) {
                    $attributes = $arg;
                }
            }

            foreach ($args as $arg) {
                // Skip the attributes array
                if (is_array($arg)) {
                    continue;
                }

                // PHP < 5.3 only calls __toString when objects are passed
                // to print/echo, so force call here
                if (is_null($attributes)) {
                    $h->open .= $h2->$fname($arg)->__toString();
                }
                else {
                    $h->open .= $h2->$fname($arg, $attributes)->__toString();
                }
            }
            return $h;
        }

        foreach ($args as $arg) {
            if (is_array($arg)) {
                // An array anywhere in the args contains attributes
                $element['attributes'] = $arg;
            }
            else if (is_string($arg)) {
                // A string anywhere in the args is a value to append to
                // the inner HTML of this element
                if (is_null($element['inner_html'])) {
                    $element['inner_html'] = '';
                }

                if ($this->escape_html) {
                    $arg = htmlentities($arg);
                }
                $element['inner_html'] .= $arg;
            }
            else if ($arg instanceof HtmlGen) {
                // If an object is found, force conversion of it into a string
                if (is_null($element['inner_html'])) {
                    $element['inner_html'] = $arg->__toString();
                }
                else {
                    $element['inner_html'] .= $arg->__toString();
                }
            }
        }

        // Build opening/closing tags for the element asked for
        switch ($action) {
            case 'open':
                // Create opening tag only, e.g.: <p>
                $h->open .= $this->render_opening_tag($element);
                break;
            case 'short':
                // Create short form of tag, e.g.: <p/>
                $h->open .= $this->render_short_tag($element);
                break;
            case 'close':
                // Create closing tag only, e.g.: </p>
                $h->close = $this->render_closing_tag($element) . $h->close;
                break;
            case 'long':
            case 'default':
            default:
                // Create long for of tag, e.g.: <p></p>
                $h->open .= $this->render_opening_tag($element);
                $h->open .= $element['inner_html'];
                $h->close = $this->render_closing_tag($element) . $h->close;
                break;
        }

        // Return copy of this object with HTML added
        return $h;
    }

    // Effectively an alias for the __call() method
    public function __get($name) {
        return $this->$name();
    }

    // Return this object's opening and closing HTML
    public function __toString() {
        return $this->open . $this->close;
    }

    // Forces rendering of this object as a string
    public function render() {
        return $this->__toString();
    }

    private function render_opening_tag_start($element) {
        $html = "<{$element['name']}";
        foreach ($element['attributes'] as $name => $value) {
            if ($this->escape_attributes) {
                $value = htmlentities($value, ENT_QUOTES);
            }
            $html .= " $name=\"$value\"";
        }
        return $html;
    }

    private function render_opening_tag($element) {
        return $this->render_opening_tag_start($element) . '>';
    }

    private function render_closing_tag($element) {
        return "</{$element['name']}>";
    }

    private function render_short_tag($element) {
        return $this->render_opening_tag_start($element) . ' />';
    }

    private function render_long_tag($element) {
        return $this->render_opening_tag($element)
             . $element['inner_html']
             . $this->render_closing_tag($element)
             ;
    }
}
