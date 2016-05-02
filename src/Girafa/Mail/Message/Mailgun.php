<?php

namespace Girafa\Mail\Message;

use Zend\Mail\Message;
use Zend\Mail\Header\GenericHeader;

class Mailgun extends Message
{

	const TAG_LIMIT = 3;

    /**
     * @var array
     */
    protected $tags = array();

    /**
     * @var array
     */
    protected $customHeaders = array();

    /**
     * @var array
     */
    protected $customVariables = array();

    /**
     * @var array
     */
    protected $options = array();

    /**
     * @var array
     */
    protected $validOptions = array(
        'campaign'          => 'o:campaign',
        'dkim'            	=> 'o:dkim',
        'delivery_time'   	=> 'o:deliverytime',
        'test_mode'       	=> 'o:testmode',
        'tracking'        	=> 'o:tracking',
        'tracking_clicks' 	=> 'o:tracking-clicks',
        'tracking_opens'  	=> 'o:tracking-opens',
        'require_tls' 		=> 'o:require-tls',
        'skip_verification' => 'o:skip-verification',
    );

    /**
     * @var array
     */
    protected $recipientVariables = array();

    /**
     * Get all tags for this message
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set all tags for this message
     *
     * @param  array $tags
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function setTags(array $tags)
    {
        if (count($tags) > self::TAG_LIMIT) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Mailgun only allows up to %s tags', self::TAG_LIMIT
            ));
        }

        $this->tags = $tags;
        return $this;
    }

    /**
     * Add a tag to this message
     *
     * @param string $tag
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function addTag($tag)
    {
        if (count($this->tags) + 1 > self::TAG_LIMIT) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Mailgun only allows up to %s tags', self::TAG_LIMIT
            ));
        }

        $this->tags[] = (string) $tag;
        return $this;
    }

    /**
     * Add options to the message
     *
     * @param  array $options
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            if (!array_key_exists($key, $this->getValidOptions())) {
                throw new Exception\InvalidArgumentException(sprintf(
                    'Invalid option "%s" given', $key
                ));
            }
        }

        $this->options = $options;
        return $this;
    }

    /**
     * Set an option to the message
     *
     * @param  string $key
     * @param  string $value
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function setOption($key, $value)
    {
        if (!array_key_exists($key, $this->getValidOptions())) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Invalid option "%s" given', $key
            ));
        }

        $this->options[$key] = $value;
        return $this;
    }

    /**
     * Get all the options of the message
     *
     * @return string[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get list of supported options
     *
     * @return array
     */
    public function getValidOptions()
    {
        return $this->validOptions;
    }

    /**
     * @param string $recipient
     * @param array $variables
     */
    public function setRecipientVariables($recipient, array $variables)
    {
        $this->recipientVariables[(string) $recipient] = $variables;
    }

    /**
     * @param string $recipient
     * @param string $key
     * @param string $value
     */
    public function addRecipientVariable($recipient, $key, $value)
    {
        $this->recipientVariables[(string) $recipient][(string) $key] = (string) $value;
    }

    /**
     * @return array
     */
    public function getRecipientVariables()
    {
        return $this->recipientVariables;
    }

    /**
     * Get all custom headers for this message
     *
     * @return array
     */
    public function getCustomHeaders()
    {
        return $this->customHeaders;
    }

    /**
     * Set all custom headers for this message
     *
     * @param  array $customHeaders
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function setCustomHeaders(array $customHeaders)
    {
        $this->customHeaders = $customHeaders;
        return $this;
    }

    /**
     * Add a custom header to this message
     *
     * @param string $customHeader
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function addCustomHeader($name, $value)
    {
        $this->customHeaders[(string) $name] = $value;
        return $this;
    }

    /**
     * Get all tags for this message
     *
     * @return array
     */
    public function getCustomVariables()
    {
        return $this->customVariables;
    }

    /**
     * Set all custom vars for this message
     *
     * @param  array $customVariables
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function setCustomVariables(array $customVariables)
    {
        $this->customVariables = $customVariables;
        return $this;
    }

    /**
     * Add a custom var to this message
     *
     * @param string $customVariable
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function addCustomVariable($name, $value)
    {
        $this->customVariables[(string) $name] = $value;
        return $this;
    }

	/**
	 * Add a Mailgun Skip Verification header to SMTP Request
	 * 
	 * @param bool $value TRUE to 'True' or FALSE to 'False'
	 * @return Girafa\Mail\Message
	 */
	public function setSkipVerificationHeader($value) {
		return $this->addCustomHeaderSmtp('Skip-Verification', $value ? 'True' : 'False');
	}

	/**
	 * Add a Mailgun Tag header to SMTP Request
	 * 
	 * @param string $tag Tag to add
	 * @return Girafa\Mail\Message
	 */
	public function addTagHeader($tag) {
		return $this->addCustomHeaderSmtp('Tag', $tag);
	}

	/**
	 * Add a Mailgun Custom Vars header to SMTP Request
	 * 
	 * @param array $vars Variables
	 * @return Girafa\Mail\Message
	 */
	public function setCustomVariablesHeader($vars) {
		$vars = (array) $vars;
		return $this->addCustomHeaderSmtp('Variables', json_encode($vars));
	}

	/**
	 * Adds a Mailgun custom header to SMTP Request
	 * 
	 * @uses Zend\Mail\Header\GenericHeader
	 * @param string $name Name of the Header
	 * @param string $value Value of the Header
	 * @return Girafa\Mail\Message
	 */ 
	public function addCustomHeaderSmtp($name, $value) {
		$this->headers->addHeader(new GenericHeader('X-Mailgun-' . $name, $value));
		return $this;
	}

}