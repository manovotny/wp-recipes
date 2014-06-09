<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

class WP_Recipe_Ingredients {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Id
    ---------------------------------------------- */

    /**
     * Getter method for id.
     *
     * @return string Recipe ingredients id.
     */
    public function get_id() {

        return $this->slug;

    }

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Ingredients
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Ingredients Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Nonce
    ---------------------------------------------- */

    /**
     * Getter method for nonce.
     *
     * @return string Recipe ingredients nonce.
     */
    public function get_nonce() {

        return $this->slug . '-nonce';

    }

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe ingredients slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-ingredients';

    /**
     * Getter method for slug.
     *
     * @return string Recipe ingredients slug.
     */
    public function get_slug() {

        return $this->slug;

    }

}
