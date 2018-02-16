<?php
namespace JSONEditor;

class JSONEditor {
    /**
     * The JSON array
     * 
     * @var array
     * @access public
     */
    public $json = [];

    /**
     * Initialize a new JSONEditor instance
     * 
     * @param string|array $json
     */
    function __construct($json) {
        if($json != null) {
            if(is_string($json)) {
                $this->json = json_decode($json, true);
            } else if(is_array($json)) {
                $this->json = $json;
            }
        }
    }

    /**
     * Add a key with a value
     * 
     * @param string $key
     * @param string|bool|array|object $value
     * @return self
     */
    function set($key, $value) {
        $this->json[$key] = $value;

        return $this;
    }

    /**
     * Remove a key (and its value)
     * 
     * @param string $key
     * @return self
     */
    function remove($key) {
        unset($this->json[$key]);

        return $this;
    }

    /**
     * Compile the edited json to a file or a string
     * 
     * @param string $file
     * @return string|JSONEditor
     */
    function compile($filepath = null, $minify = false) {
        if($filepath != null && file_exists($filepath)) {
            file_put_contents($filepath, json_encode($this->json, !$minify ? JSON_PRETTY_PRINT : 0));
            return $this;
        }
        
        return json_encode($this->json);
    }
}