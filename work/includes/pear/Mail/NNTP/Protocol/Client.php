<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 foldmethod=marker: */

/**
 * 
 * 
 * PHP versions 4 and 5
 *
 * <pre>
 * +-----------------------------------------------------------------------+
 * |                                                                       |
 * | W3C� SOFTWARE NOTICE AND LICENSE                                      |
 * | http://www.w3.org/Consortium/Legal/2002/copyright-software-20021231   |
 * |                                                                       |
 * | This work (and included software, documentation such as READMEs,      |
 * | or other related items) is being provided by the copyright holders    |
 * | under the following license. By obtaining, using and/or copying       |
 * | this work, you (the licensee) agree that you have read, understood,   |
 * | and will comply with the following terms and conditions.              |
 * |                                                                       |
 * | Permission to copy, modify, and distribute this software and its      |
 * | documentation, with or without modification, for any purpose and      |
 * | without fee or royalty is hereby granted, provided that you include   |
 * | the following on ALL copies of the software and documentation or      |
 * | portions thereof, including modifications:                            |
 * |                                                                       |
 * | 1. The full text of this NOTICE in a location viewable to users       |
 * |    of the redistributed or derivative work.                           |
 * |                                                                       |
 * | 2. Any pre-existing intellectual property disclaimers, notices,       |
 * |    or terms and conditions. If none exist, the W3C Software Short     |
 * |    Notice should be included (hypertext is preferred, text is         |
 * |    permitted) within the body of any redistributed or derivative      |
 * |    code.                                                              |
 * |                                                                       |
 * | 3. Notice of any changes or modifications to the files, including     |
 * |    the date changes were made. (We recommend you provide URIs to      |
 * |    the location from which the code is derived.)                      |
 * |                                                                       |
 * | THIS SOFTWARE AND DOCUMENTATION IS PROVIDED "AS IS," AND COPYRIGHT    |
 * | HOLDERS MAKE NO REPRESENTATIONS OR WARRANTIES, EXPRESS OR IMPLIED,    |
 * | INCLUDING BUT NOT LIMITED TO, WARRANTIES OF MERCHANTABILITY OR        |
 * | FITNESS FOR ANY PARTICULAR PURPOSE OR THAT THE USE OF THE SOFTWARE    |
 * | OR DOCUMENTATION WILL NOT INFRINGE ANY THIRD PARTY PATENTS,           |
 * | COPYRIGHTS, TRADEMARKS OR OTHER RIGHTS.                               |
 * |                                                                       |
 * | COPYRIGHT HOLDERS WILL NOT BE LIABLE FOR ANY DIRECT, INDIRECT,        |
 * | SPECIAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF ANY USE OF THE        |
 * | SOFTWARE OR DOCUMENTATION.                                            |
 * |                                                                       |
 * | The name and trademarks of copyright holders may NOT be used in       |
 * | advertising or publicity pertaining to the software without           |
 * | specific, written prior permission. Title to copyright in this        |
 * | software and any associated documentation will at all times           |
 * | remain with copyright holders.                                        |
 * |                                                                       |
 * +-----------------------------------------------------------------------+
 * </pre>
 *
 * @category   Net
 * @package    Net_NNTP
 * @author     Heino H. Gehlsen <heino@gehlsen.dk>
 * @copyright  2002-2005 Heino H. Gehlsen <heino@gehlsen.dk>. All Rights Reserved.
 * @license    http://www.w3.org/Consortium/Legal/2002/copyright-software-20021231 W3C� SOFTWARE NOTICE AND LICENSE
 * @version    CVS: $Id: Client.php,v 1.16 2006/02/28 17:51:50 heino Exp $
 * @link       http://pear.php.net/package/Net_NNTP
 * @see        
 */

/**
 *
 */
require_once 'PEAR.php';
require_once 'Net/Socket.php';
//require_once 'Net/NNTP/Error.php';
require_once 'Net/NNTP/Protocol/Responsecode.php';


// {{{ constants

/**
 * Default host
 *
 * @access     public
 * @ignore
 */
define('NET_NNTP_PROTOCOL_CLIENT_DEFAULT_HOST', 'localhost');

/**
 * Default port
 *
 * @access     public
 * @ignore
 */
define('NET_NNTP_PROTOCOL_CLIENT_DEFAULT_PORT', '119');

// }}}
// {{{ Net_NNTP_Protocol_Client

/**
 * Low level NNTP Client
 *
 * Implements the client part of the NNTP standard acording to:
 *  - RFC 977,
 *  - RFC 2980,
 *  - RFC 850/1036, and
 *  - RFC 822/2822
 *
 * Each NNTP command is represented by a method: cmd*()
 *
 * WARNING: The Net_NNTP_Protocol_Client class is considered an internal class
 *          (and should therefore currently not be extended directly outside of
 *          the Net_NNTP package). Therefore its API is NOT required to be fully
 *          stable, for as long as such changes doesn't affect the public API of
 *          the Net_NNTP_Client class, which is considered stable.
 *
 * TODO:	cmdListActiveTimes()
 *      	cmdDistribPats()
 *
 * @category   Net
 * @package    Net_NNTP
 * @author     Heino H. Gehlsen <heino@gehlsen.dk>
 * @version    package: 1.4.0RC1 (beta)
 * @version    api: 0.8.1 (alpha)
 * @access     private
 * @see        Net_NNTP_Client
 */
class Net_NNTP_Protocol_Client extends PEAR
{
    // {{{ properties

    /**
     * The socket resource being used to connect to the NNTP server.
     *
     * @var resource
     * @access private
     */
    var $_socket = null;

    /**
     * Contains the last recieved status response code and text
     *
     * @var array
     * @access private
     */
    var $_currentStatusResponse = null;

    /**
     * 
     *
     * @var     object
     * @access  private
     */
    var $_logger = null;

    // }}}
    // {{{ constructor
	    
    /**
     * Constructor
     *
     * @access public
     */
    function Net_NNTP_Protocol_Client() {

    	//
//    	parent::PEAR('Net_NNTP_Error');
    	parent::PEAR();

    	//
    	$this->_socket = new Net_Socket();
    }

    // }}}
    // {{{ setLogger()

    /**
     *
     *
     * @param object $logger
     *
     * @access protected
     */
    function setLogger($logger)
    {
        $this->_logger = $logger;
    }

    // }}}
    // {{{ setDebug()

    /**
     * @deprecated
     */
    function setDebug($debug = true)
    {
    	trigger_error('You are using deprecated API v1.0 in Net_NNTP_Protocol_Client: setDebug() ! Debugging in now automatically handled when a logger is given.', E_USER_NOTICE);
    }

    // }}}
    // {{{ _sendCommand()

    /**
     * Send command
     *
     * Send a command to the server. A carriage return / linefeed (CRLF) sequence
     * will be appended to each command string before it is sent to the IMAP server.
     *
     * @param string $cmd The command to launch, ie: "ARTICLE 1004853"
     *
     * @return mixed (int) response code on success or (object) pear_error on failure
     * @access private
     */
    function _sendCommand($cmd)
    {
        // NNTP/RFC977 only allows command up to 512 (-2) chars.
        if (!strlen($cmd) > 510) {
            return $this->throwError('Failed writing to socket! (Command to long - max 510 chars)');
        }

/* Handled internally in Net_Socket
    	// Check if connected
    	if (!$this->_isConnected()) {
            return $this->_socket->throwError('Failed to write to socket! (connection lost!)');
        }
*/

    	// Send the command
    	$R = $this->_socket->writeLine($cmd);
        if ( PEAR::isError($R) ) {
            return $R;
        }
	
    	//
    	if ($this->_logger && $this->_logger->_isMasked(PEAR_LOG_DEBUG)) {
    	    $this->_logger->debug('C: ' . $cmd);
        }

    	//
    	return $this->_getStatusResponse();
    }
    
    // }}}
    // {{{ _getStatusResponse()

    /**
     * Get servers status response after a command.
     *
     * @return mixed (int) statuscode on success or (object) pear_error on failure
     * @access private
     */
    function _getStatusResponse()
    {
    	// Retrieve a line (terminated by "\r\n") from the server.
    	$response = $this->_socket->gets(256);
        if (PEAR::isError($response) ) {
    	    return $response;
        }

    	//
    	if ($this->_logger && $this->_logger->_isMasked(PEAR_LOG_DEBUG)) {
    	    $this->_logger->debug('S: ' . rtrim($response, "\r\n"));
        }

    	// Trim the start of the response in case of misplased whitespace (should not be needen!!!)
    	$response = ltrim($response);

        $this->_currentStatusResponse = array(
    	    	    	    	    	      (int) substr($response, 0, 3),
    	                                      (string) rtrim(substr($response, 4))
    	    	    	    	    	     );

    	//
    	return $this->_currentStatusResponse[0];
    }
    
    // }}}
    // {{{ _getTextResponse()

    /**
     * Retrieve textural data
     *
     * Get data until a line with only a '.' in it is read and return data.
     *
     * @return mixed (array) text response on success or (object) pear_error on failure
     * @access private
     */
    function _getTextResponse()
    {
        $data = array();
        $line = '';

    	//
    	$debug = $this->_logger && $this->_logger->_isMasked(PEAR_LOG_DEBUG);

        // Continue until connection is lost
        while(!$this->_socket->eof()) {

            // Retrieve and append up to 1024 characters from the server.
            $line .= $this->_socket->gets(1024); 
            if (PEAR::isError($line) ) {
    	    	return $line;
    	    }
	    
            // Continue if the line is not terminated by CRLF
            if (substr($line, -2) != "\r\n" || strlen($line) < 2) {
                continue;
            }

            // Validate recieved line
            if (false) {
                // Lines should/may not be longer than 998+2 chars (RFC2822 2.3)
                if (strlen($line) > 1000) {
    	    	    if ($this->_logger) {
    	    	    	$this->_logger->notice('Max line length...');
    	    	    }
                    return $this->throwError('Invalid line recieved!', null);
                }
            }

            // Remove CRLF from the end of the line
            $line = substr($line, 0, -2);

            // Check if the line terminates the textresponse
            if ($line == '.') {

    	    	if ($this->_logger) {
    	    	    $this->_logger->debug('T: ' . $line);
    	    	}

                // return all previous lines
                return $data;
            }

            // If 1st char is '.' it's doubled (NNTP/RFC977 2.4.1)
            if (substr($line, 0, 2) == '..') {
                $line = substr($line, 1);
            }
            
    	    //
    	    if ($debug) {
    	    	$this->_logger->debug('T: ' . $line);
    	    }

            // Add the line to the array of lines
            $data[] = $line;

            // Reset/empty $line
            $line = '';
        }

    	//
    	return $this->throwError('Data stream not terminated with period', null);
    }

    // }}}
    // {{{ _sendText()

    /**
     *
     *
     * @access private
     */
    function _sendArticle($article)
    {
    	/* data should be in the format specified by RFC850 */
	    
    	switch (true) {
    	case is_string($article):
    	    //
    	    $this->_socket->write($article);
    	    $this->_socket->write("\r\n.\r\n");

    	    //
    	    if ($this->_logger && $this->_logger->_isMasked(PEAR_LOG_DEBUG)) {
    	        foreach (explode("\r\n", $article) as $line) {
    		    $this->_logger->debug('D: ' . $line);
    	        }
    	    	$this->_logger->debug('D: .');
    	    }
	    break;

    	case is_array($article):
    	    //
    	    $header = reset($article);
    	    $body = next($article);

/* Experimental...
    	    // If header is an array, implode it.
    	    if (is_array($header)) {
    	        $header = implode("\r\n", $header) . "\r\n";
    	    }
*/

    	    // Send header (including separation line)
    	    $this->_socket->write($header);
    	    $this->_socket->write("\r\n");

    	    //
    	    if ($this->_logger && $this->_logger->_isMasked(PEAR_LOG_DEBUG)) {
    	        foreach (explode("\r\n", $header) as $line) {
    	    	    $this->_logger->debug('D: ' . $line);
    	    	}
    	    }


/* Experimental...
    	    // If body is an array, implode it.
    	    if (is_array($body)) {
    	        $header = implode("\r\n", $body) . "\r\n";
    	    }
*/

    	    // Send body
    	    $this->_socket->write($body);
    	    $this->_socket->write("\r\n.\r\n");

    	    //
    	    if ($this->_logger && $this->_logger->_isMasked(PEAR_LOG_DEBUG)) {
    	        foreach (explode("\r\n", $body) as $line) {
    	    	    $this->_logger->debug('D: ' . $line);
    	    	}
    	        $this->_logger->debug('D: .');
    	    }
	    break;

	default:
    	    return $this->throwError('Ups...', null, null);
    	}

	return true;
    }

    // }}}
    // {{{ _currentStatusResponse()

    /**
     *
     *
     * @return string status text
     * @access private
     */
    function _currentStatusResponse()
    {
    	return $this->_currentStatusResponse[1];
    }
    
    // }}}
    // {{{ _handleUnexpectedResponse()

    /**
     *
     *
     * @param int $code Status code number
     * @param string $text Status text
     *
     * @return mixed
     * @access private
     */
    function _handleUnexpectedResponse($code = null, $text = null)
    {
    	if ($code === null) {
    	    $code = $this->_currentStatusResponse[0];
	}

    	if ($text === null) {
    	    $text = $this->_currentStatusResponse();
	}

    	switch ($code) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NOT_PERMITTED: // 502, 'access restriction or permission denied' / service permanently unavailable
    	    	return $this->throwError('Command not permitted / Access restriction / Permission denied', $code, $text);
    	    	break;
    	    default:
    	    	return $this->throwError("Unexpected response: '$text'", $code, $text);
    	}
    }

    // }}}

/* Session administration commands */

    // {{{ Connect()

    /**
     * Connect to a NNTP server
     *
     * @param string	$host	(optional) The address of the NNTP-server to connect to, defaults to 'localhost'.
     * @param mixed	$encryption	(optional) 
     * @param int	$port	(optional) The port number to connect to, defaults to 119.
     * @param int	$timeout	(optional) 
     *
     * @return mixed (bool) on success (true when posting allowed, otherwise false) or (object) pear_error on failure
     * @access protected
     */
    function connect($host = null, $encryption = null, $port = null, $timeout = null)
    {
    	//
        if ($this->_isConnected() ) {
    	    return $this->throwError('Already connected, disconnect first!', null);
    	}

    	// v1.0.x API
    	if (is_int($encryption)) {
	    trigger_error('You are using deprecated API v1.0 in Net_NNTP_Protocol_Client: connect() !', E_USER_NOTICE);
    	    $port = $encryption;
	    $encryption = false;
    	}

    	//
    	if (is_null($host)) {
    	    $host = 'localhost';
    	}

    	// Choose transport based on encryption, and if no port is given, use default for that encryption
    	switch ($encryption) {
	    case null:
	    case false:
		$transport = 'tcp';
    	    	$port = is_null($port) ? 119 : $port;
		break;
	    case 'ssl':
	    case 'tls':
		$transport = $encryption;
    	    	$port = is_null($port) ? 563 : $port;
		break;
	    default:
    	    	trigger_error('$encryption parameter must be either tcp, tls or ssl.', E_USER_ERROR);
    	}

    	//
    	if (is_null($timeout)) {
    	    $timeout = 15;
    	}

    	// Open Connection
    	$R = @$this->_socket->connect($transport . '://' . $host, $port, false, $timeout);
    	if (PEAR::isError($R)) {
    	    if ($this->_logger) {
    	        $this->_logger->notice("Connection to $transport://$host:$port failed.");
    	    }
    	    return $R;
    	}

    	//
    	if ($this->_logger) {
    	    $this->_logger->info("Connection to $transport://$host:$port has been established.");
    	}

    	// Retrive the server's initial response.
    	$response = $this->_getStatusResponse();
    	if (PEAR::isError($response)) {
    	    return $response;
        }

        switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_READY_POSTING_ALLOWED: // 200, Posting allowed
    	    	// TODO: Set some variable before return

    	        return true;
    	        break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_READY_POSTING_PROHIBITED: // 201, Posting NOT allowed
    	        //
    	    	if ($this->_logger) {
    	    	    $this->_logger->info('Posting not allowed!');
    	    	}

	    	// TODO: Set some variable before return

    	    	return false;
    	        break;
    	    case 400:
    	    	return $this->throwError('Server refused connection', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NOT_PERMITTED: // 502, 'access restriction or permission denied' / service permanently unavailable
    	    	return $this->throwError('Server refused connection', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ disconnect()

    /**
     * alias for cmdQuit()
     *
     * @access protected
     */
    function disconnect()
    {
    	return $this->cmdQuit();
    }

    // }}}
    // {{{ cmdCapabilities()

    /**
     * Returns servers capabilities
     *
     * @return mixed (array) list of capabilities on success or (object) pear_error on failure 
     * @access protected
     */
    function cmdCapabilities()
    {
        // tell the newsserver we want an article
        $response = $this->_sendCommand('CAPABILITIES');
        if (PEAR::isError($response)) {
            return $response;
        }
	
    	switch ($response) {
            case NET_NNTP_PROTOCOL_RESPONSECODE_CAPABILITIES_FOLLOW: // 101, Draft: 'Capability list follows'
    	    	$data = $this->_getTextResponse();
    	    	if (PEAR::isError($data)) {
    	    	    return $data;
    	    	}
    	    	return $data;
    	        break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdModeReader()

    /**
     * 
     *
     * @return mixed (bool) true when posting allowed, false when postind disallowed or (object) pear_error on failure 
     * @access protected
     */
    function cmdModeReader()
    {
        // tell the newsserver we want an article
        $response = $this->_sendCommand('MODE READER');
        if (PEAR::isError($response)) {
            return $response;
        }
	
    	switch ($response) {
            case NET_NNTP_PROTOCOL_RESPONSECODE_READY_POSTING_ALLOWED: // 200, RFC2980: 'Hello, you can post'

	    	// TODO: Set some variable before return

    	    	return true;
    	        break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_READY_POSTING_PROHIBITED: // 201, RFC2980: 'Hello, you can't post'
    	    	if ($this->_logger) {
    	    	    $this->_logger->info('Posting not allowed!');
    	    	}

	    	// TODO: Set some variable before return

    	    	return false;
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NOT_PERMITTED: // 502, 'access restriction or permission denied' / service permanently unavailable
    	    	return $this->throwError('Connection being closed, since service so permanently unavailable', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdQuit()

    /**
     * Disconnect from the NNTP server
     *
     * @return mixed (bool) true on success or (object) pear_error on failure 
     * @access protected
     */
    function cmdQuit()
    {
    	// Tell the server to close the connection
    	$response = $this->_sendCommand('QUIT');
        if (PEAR::isError($response)) {
            return $response;
    	}
	
        switch ($response) {
    	    case 205: // RFC977: 'closing connection - goodbye!'
    	    	// If socket is still open, close it.
    	    	if ($this->_isConnected()) {
    	    	    $this->_socket->disconnect();
    	    	}

    	    	if ($this->_logger) {
    	    	    $this->_logger->info('Connection closed.');
    	    	}

    	    	return true;
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}

/* Article posting and retrieval */

    /* Group and article selection */

    // {{{ cmdGroup()

    /**
     * Selects a news group (issue a GROUP command to the server)
     *
     * @param string $newsgroup The newsgroup name
     *
     * @return mixed (array) groupinfo on success or (object) pear_error on failure
     * @access protected
     */
    function cmdGroup($newsgroup)
    {
        $response = $this->_sendCommand('GROUP '.$newsgroup);
        if (PEAR::isError($response)) {
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_GROUP_SELECTED: // 211, RFC977: 'n f l s group selected'
    	    	$response_arr = split(' ', trim($this->_currentStatusResponse()));

    	    	return array('group' => $response_arr[3],
    	                     'first' => (int) $response_arr[1],
    	    	             'last'  => (int) $response_arr[2],
    	                     'count' => (int) $response_arr[0]);
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_SUCH_GROUP: // 411, RFC977: 'no such news group'
    	    	return $this->throwError('No such news group', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdListgroup()

    /**
     *
     *
     * @param optional string $newsgroup 
     * @param optional mixed $range 
     *
     * @return optional mixed (array) on success or (object) pear_error on failure
     * @access protected
     */
    function cmdListgroup($newsgroup = null, $range = null)
    {
        if (is_null($newsgroup)) {
    	    $command = 'LISTGROUP';
    	} else {
    	    if (is_null($range)) {
    	        $command = 'LISTGROUP ' . $newsgroup;
    	    } else {
    	        $command = 'LISTGROUP ' . $newsgroup . ' ' . $range;
    	    }
        }

        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_GROUP_SELECTED: // 211, RFC2980: 'list of article numbers follow'

    	    	$articles = $this->_getTextResponse();
    	        if (PEAR::isError($articles)) {
    	            return $articles;
    	        }
		
    	        $response_arr = split(' ', trim($this->_currentStatusResponse()), 4);

		// If server does not return group summary in status response, return null'ed array
    	    	if (!is_int($response_arr[0]) || !is_int($response_arr[1]) || !is_int($response_arr[2]) || is_empty($response_arr[3])) {
    	    	    return array('group'    => null,
    	        	         'first'    => null,
    	    	    	         'last'     => null,
    	    	    		 'count'    => null,
    	    	    	         'articles' => $articles);
		}

    	    	return array('group'    => $response_arr[3],
    	                     'first'    => (int) $response_arr[1],
    	    	             'last'     => (int) $response_arr[2],
    	    	             'count'    => (int) $response_arr[0],
    	    	             'articles' => $articles);
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_GROUP_SELECTED: // 412, RFC2980: 'Not currently in newsgroup'
    	    	return $this->throwError('Not currently in newsgroup', $response, $this->_currentStatusResponse());
    	    	break;
    	    case 502: // RFC2980: 'no permission'
    	    	return $this->throwError('No permission', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdLast()

    /**
     * 
     *
     * @return mixed (array) or (string) or (int) or (object) pear_error on failure
     * @access protected
     */
    function cmdLast()
    {
        // 
        $response = $this->_sendCommand('LAST');
        if (PEAR::isError($response)) {
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_ARTICLE_SELECTED: // 223, RFC977: 'n a article retrieved - request text separately (n = article number, a = unique article id)'
    	    	$response_arr = split(' ', trim($this->_currentStatusResponse()));
    	    	return array((int) $response_arr[0], (string) $response_arr[1]);
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_GROUP_SELECTED: // 412, RFC977: 'no newsgroup selected'
    	    	return $this->throwError('No newsgroup has been selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_ARTICLE_SELECTED: // 420, RFC977: 'no current article has been selected'
    	    	return $this->throwError('No current article has been selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_PREVIOUS_ARTICLE: // 422, RFC977: 'no previous article in this group'
    	    	return $this->throwError('No previous article in this group', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdNext()

    /**
     * 
     *
     * @return mixed (array) or (string) or (int) or (object) pear_error on failure
     * @access protected
     */
    function cmdNext()
    {
        // 
        $response = $this->_sendCommand('NEXT');
        if (PEAR::isError($response)) {
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_ARTICLE_SELECTED: // 223, RFC977: 'n a article retrieved - request text separately (n = article number, a = unique article id)'
    	    	$response_arr = split(' ', trim($this->_currentStatusResponse()));
    	    	return array((int) $response_arr[0], (string) $response_arr[1]);
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_GROUP_SELECTED: // 412, RFC977: 'no newsgroup selected'
    	    	return $this->throwError('No newsgroup has been selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_ARTICLE_SELECTED: // 420, RFC977: 'no current article has been selected'
    	    	return $this->throwError('No current article has been selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_NEXT_ARTICLE: // 421, RFC977: 'no next article in this group'
    	    	return $this->throwError('No next article in this group', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}

    /* Retrieval of articles and article sections */

    // {{{ cmdArticle()

    /**
     * Get an article from the currently open connection.
     *
     * @param mixed $article Either a message-id or a message-number of the article to fetch. If null or '', then use current article.
     *
     * @return mixed (array) article on success or (object) pear_error on failure 
     * @access protected
     */
    function cmdArticle($article = null)
    {
        if (is_null($article)) {
    	    $command = 'ARTICLE';
    	} else {
            $command = 'ARTICLE ' . $article;
        }

        // tell the newsserver we want an article
        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)) {
            return $response;
        }
	
    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_ARTICLE_FOLLOWS:  // 220, RFC977: 'n <a> article retrieved - head and body follow (n = article number, <a> = message-id)'
    	    	$data = $this->_getTextResponse();
    	    	if (PEAR::isError($data)) {
    	    	    return $data;
    	    	}
    	    	return $data;
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_GROUP_SELECTED: // 412, RFC977: 'no newsgroup has been selected'
    	    	return $this->throwError('No newsgroup has been selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_ARTICLE_SELECTED: // 420, RFC977: 'no current article has been selected'
    	    	return $this->throwError('No current article has been selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_SUCH_ARTICLE_NUMBER: // 423, RFC977: 'no such article number in this group'
    	    	return $this->throwError('No such article number in this group', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_SUCH_ARTICLE_ID: // 430, RFC977: 'no such article found'
    	    	return $this->throwError('No such article found', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdHead()

    /**
     * Get the headers of an article from the currently open connection.
     *
     * @param mixed $article Either a message-id or a message-number of the article to fetch the headers from. If null or '', then use current article.
     *
     * @return mixed (array) headers on success or (object) pear_error on failure 
     * @access protected
     */
    function cmdHead($article = null)
    {
        if (is_null($article)) {
    	    $command = 'HEAD';
    	} else {
            $command = 'HEAD ' . $article;
        }

        // tell the newsserver we want the header of an article
        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)) {
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_HEAD_FOLLOWS:     // 221, RFC977: 'n <a> article retrieved - head follows'
    	    	$data = $this->_getTextResponse();
    	    	if (PEAR::isError($data)) {
    	    	    return $data;
	    	}
    	        return $data;
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_GROUP_SELECTED: // 412, RFC977: 'no newsgroup has been selected'
    	    	return $this->throwError('No newsgroup has been selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_ARTICLE_SELECTED: // 420, RFC977: 'no current article has been selected'
    	    	return $this->throwError('No current article has been selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_SUCH_ARTICLE_NUMBER: // 423, RFC977: 'no such article number in this group'
    	    	return $this->throwError('No such article number in this group', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_SUCH_ARTICLE_ID: // 430, RFC977: 'no such article found'
    	    	return $this->throwError('No such article found', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdBody()

    /**
     * Get the body of an article from the currently open connection.
     *
     * @param mixed $article Either a message-id or a message-number of the article to fetch the body from. If null or '', then use current article.
     *
     * @return mixed (array) body on success or (object) pear_error on failure 
     * @access protected
     */
    function cmdBody($article = null)
    {
        if (is_null($article)) {
    	    $command = 'BODY';
    	} else {
            $command = 'BODY ' . $article;
        }

        // tell the newsserver we want the body of an article
        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)) {
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_BODY_FOLLOWS:     // 222, RFC977: 'n <a> article retrieved - body follows'
    	    	$data = $this->_getTextResponse();
    	    	if (PEAR::isError($data)) {
    	    	    return $data;
    	    	}
    	        return $data;
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_GROUP_SELECTED: // 412, RFC977: 'no newsgroup has been selected'
    	    	return $this->throwError('No newsgroup has been selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_ARTICLE_SELECTED: // 420, RFC977: 'no current article has been selected'
    	    	return $this->throwError('No current article has been selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_SUCH_ARTICLE_NUMBER: // 423, RFC977: 'no such article number in this group'
    	    	return $this->throwError('No such article number in this group', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_SUCH_ARTICLE_ID: // 430, RFC977: 'no such article found'
    	    	return $this->throwError('No such article found', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdStat

    /**
     * 
     *
     * @param mixed $article 
     *
     * @return mixed (array) or (string) or (int) or (object) pear_error on failure 
     * @access protected
     */
    function cmdStat($article = null)
    {
        if (is_null($article)) {
    	    $command = 'STAT';
    	} else {
            $command = 'STAT ' . $article;
        }

        // tell the newsserver we want an article
        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)) {
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_ARTICLE_SELECTED: // 223, RFC977: 'n <a> article retrieved - request text separately' (actually not documented, but copied from the ARTICLE command)
    	    	$response_arr = split(' ', trim($this->_currentStatusResponse()));
    	    	return array((int) $response_arr[0], (string) $response_arr[1]);
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_GROUP_SELECTED: // 412, RFC977: 'no newsgroup has been selected' (actually not documented, but copied from the ARTICLE command)
    	    	return $this->throwError('No newsgroup has been selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_SUCH_ARTICLE_NUMBER: // 423, RFC977: 'no such article number in this group' (actually not documented, but copied from the ARTICLE command)
    	    	return $this->throwError('No such article number in this group', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_SUCH_ARTICLE_ID: // 430, RFC977: 'no such article found' (actually not documented, but copied from the ARTICLE command)
    	    	return $this->throwError('No such article found', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}

    /* Article posting */

    // {{{ cmdPost()

    /**
     * Post an article to a newsgroup.
     *
     * @return mixed (bool) true on success or (object) pear_error on failure
     * @access protected
     */
    function cmdPost()
    {
        // tell the newsserver we want to post an article
    	$response = $this->_sendCommand('POST');
    	if (PEAR::isError($response)) {
    	    return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_POSTING_SEND: // 340, RFC977: 'send article to be posted. End with <CR-LF>.<CR-LF>'
    	    	return true;
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_POSTING_PROHIBITED: // 440, RFC977: 'posting not allowed'
    	    	return $this->throwError('Posting not allowed', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}

    }

    // }}}
    // {{{ cmdPost2()

    /**
     * Post an article to a newsgroup.
     *
     * @param mixed $article (string/array)
     *
     * @return mixed (bool) true on success or (object) pear_error on failure
     * @access protected
     */
    function cmdPost2($article)
    {
    	/* should be presented in the format specified by RFC850 */

    	//
    	$this->_sendArticle($article);

    	// Retrive server's response.
    	$response = $this->_getStatusResponse();
    	if (PEAR::isError($response)) {
    	    return $response;
    	}

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_POSTING_SUCCESS: // 240, RFC977: 'article posted ok'
    	    	return true;
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_POSTING_FAILURE: // 441, RFC977: 'posting failed'
    	    	return $this->throwError('Posting failed', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdIhave()

    /**
     *
     *
     * @param string $id
     *
     * @return mixed (bool) true on success or (object) pear_error on failure
     * @access protected
     */
    function cmdIhave($id)
    {
        // tell the newsserver we want to post an article
    	$response = $this->_sendCommand('IHAVE ' . $id);
    	if (PEAR::isError($response)) {
    	    return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_TRANSFER_SEND: // 335
    	    	true;
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_TRANSFER_UNWANTED: // 435
    	    	return $this->throwError('Article not wanted', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_TRANSFER_FAILURE: // 436
    	    	return $this->throwError('Transfer not possible; try again later', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdIhave2()

    /**
     *
     *
     * @param mixed $article (string/array)
     *
     * @return mixed (bool) true on success or (object) pear_error on failure
     * @access protected
     */
    function cmdIhave2($article)
    {
    	/* should be presented in the format specified by RFC850 */

    	//
    	$this->_sendArticle($article);
	    
    	// Retrive server's response.
    	$response = $this->_getStatusResponse();
    	if (PEAR::isError($response)) {
    	    return $response;
    	}

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_TRANSFER_SUCCESS: // 235
    	    	return true;
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_TRANSFER_FAILURE: // 436
    	    	return $this->throwError('Transfer not possible; try again later', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_TRANSFER_REJECTED: // 437
    	    	return $this->throwError('Transfer rejected; do not retry', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}

/* Information commands */

    // {{{ cmdDate()

    /**
     * Get the date from the newsserver format of returned date
     *
     * @return mixed (string) 'YYYYMMDDhhmmss' / (int) timestamp on success or (object) pear_error on failure
     * @access protected
     */
    function cmdDate()
    {
        $response = $this->_sendCommand('DATE');
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_SERVER_DATE: // 111, RFC2980: 'YYYYMMDDhhmmss'
    	        return $this->_currentStatusResponse();
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }
    // }}}
    // {{{ cmdHelp()

    /**
     * Returns the server's help text
     *
     * @return mixed (array) help text on success or (object) pear_error on failure 
     * @access protected
     */
    function cmdHelp()
    {
        // tell the newsserver we want an article
        $response = $this->_sendCommand('HELP');
        if (PEAR::isError($response)) {
            return $response;
        }
	
    	switch ($response) {
            case NET_NNTP_PROTOCOL_RESPONSECODE_HELP_FOLLOWS: // 100
    	    	$data = $this->_getTextResponse();
    	    	if (PEAR::isError($data)) {
    	    	    return $data;
    	    	}
    	    	return $data;
    	        break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdNewgroups()

    /**
     * Fetches a list of all newsgroups created since a specified date.
     *
     * @param int $time Last time you checked for groups (timestamp).
     * @param optional string $distributions (deprecaded in rfc draft)
     *
     * @return mixed (array) nested array with informations about existing newsgroups on success or (object) pear_error on failure
     * @access protected
     */
    function cmdNewgroups($time, $distributions = null)
    {
	$date = gmdate('ymd His', $time);

        if (is_null($distributions)) {
    	    $command = 'NEWGROUPS ' . $date . ' GMT';
    	} else {
    	    $command = 'NEWGROUPS ' . $date . ' GMT <' . $distributions . '>';
        }

        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NEW_GROUPS_FOLLOW: // 231, REF977: 'list of new newsgroups follows'
    	    	$data = $this->_getTextResponse();
    	    	if (PEAR::isError($data)) {
    	    	    return $data;
    	    	}

    	    	$groups = array();
    	    	foreach($data as $line) {
    	    	    $arr = explode(' ', trim($line));

    	    	    $group = array('group'   => $arr[0],
    	    	                   'last'    => (int) $arr[1],
    	    	                   'first'   => (int) $arr[2],
    	    	                   'posting' => $arr[3]);

    	    	    $groups[$group['group']] = $group;
    	    	}
    	        return $groups;



    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdNewnews()

    /**
     *
     *
     * @param timestamp $time
     * @param mixed $newsgroups (string or array of strings)
     * @param mixed $distribution (string or array of strings)
     *
     * @return mixed 
     * @access protected
     */
    function cmdNewnews($time, $newsgroups, $distribution = null)
    {
        $date = gmdate('ymd His', $time);

    	if (is_array($newsgroups)) {
    	    $newsgroups = implode(',', $newsgroups);
    	}

        if (is_null($distribution)) {
    	    $command = 'NEWNEWS ' . $newsgroups . ' ' . $date . ' GMT';
    	} else {
    	    if (is_array()) {
    		$distribution = implode(',', $distribution);
    	    }

    	    $command = 'NEWNEWS ' . $newsgroups . ' ' . $date . ' GMT <' . $distribution . '>';
        }

	// TODO: the lenght of the request string may not exceed 510 chars
	
        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NEW_ARTICLES_FOLLOW: // 230, RFC977: 'list of new articles by message-id follows'
    	    	$messages = array();
    	    	foreach($this->_getTextResponse() as $line) {
    	    	    $messages[] = $line;
    	    	}
    	    	return $messages;
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}

    /* The LIST commands */

    // {{{ cmdList()

    /**
     * Fetches a list of all avaible newsgroups
     *
     * @return mixed (array) nested array with informations about existing newsgroups on success or (object) pear_error on failure
     * @access protected
     */
    function cmdList()
    {
        $response = $this->_sendCommand('LIST');
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_GROUPS_FOLLOW: // 215, RFC977: 'list of newsgroups follows'
    	    	$data = $this->_getTextResponse();
    	    	if (PEAR::isError($data)) {
    	    	    return $data;
    	    	}

    	    	$groups = array();
    	    	foreach($data as $line) {
    	    	    $arr = explode(' ', trim($line));

    	    	    $group = array('group'   => $arr[0],
    	    	                   'last'    => (int) $arr[1],
    	    	                   'first'   => (int) $arr[2],
    	    	                   'posting' => $arr[3]);

    	    	    $groups[$group['group']] = $group;
    	    	}
    	        return $groups;
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdListActive()

    /**
     * Fetches a list of all avaible newsgroups
     *
     * @param string $wildmat 
     *
     * @return mixed (array) nested array with informations about existing newsgroups on success or (object) pear_error on failure
     * @access protected
     */
    function cmdListActive($wildmat = null)
    {
        if (is_null($wildmat)) {
    	    $command = 'LIST ACTIVE';
    	} else {
            $command = 'LIST ACTIVE ' . $wildmat;
        }

        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_GROUPS_FOLLOW: // 215, RFC977: 'list of newsgroups follows'
    	    	$data = $this->_getTextResponse();
    	    	if (PEAR::isError($data)) {
    	    	    return $data;
    	    	}

    	    	$groups = array();
    	    	foreach($data as $line) {
    	    	    $arr = explode(' ', trim($line));

    	    	    $group = array('group'   => $arr[0],
    	    	                   'last'    => (int) $arr[1],
    	    	                   'first'   => (int) $arr[2],
    	    	                   'posting' => $arr[3]);

    	    	    $groups[$group['group']] = $group;
    	    	}
    	        return $groups;
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdListNewsgroups()

    /**
     * Fetches a list of (all) avaible newsgroup descriptions.
     *
     * @param string $wildmat Wildmat of the groups, that is to be listed, defaults to null;
     *
     * @return mixed (array) nested array with description of existing newsgroups on success or (object) pear_error on failure
     * @access protected
     */
    function cmdListNewsgroups($wildmat = null)
    {
        if (is_null($wildmat)) {
    	    $command = 'LIST NEWSGROUPS';
    	} else {
            $command = 'LIST NEWSGROUPS ' . $wildmat;
        }

        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_GROUPS_FOLLOW: // 215, RFC2980: 'information follows'
    	    	$data = $this->_getTextResponse();
    	        if (PEAR::isError($data)) {
    	            return $data;
    	        }

    	    	$groups = array();

    	        foreach($data as $line) {
    	            if (preg_match("/^(\S+)\s+(.*)$/", ltrim($line), $matches)) {
    	    	        $groups[$matches[1]] = (string) $matches[2];
    	    	    } else {
    	    	        if ($this->_logger) {
    	    	            $this->_logger->warning("Recieved non-standard line: '$line'");
    	    	        }
    	    	    }
    	        }

    	        return $groups;
    		break;
    	    case 503: // RFC2980: 'program error, function not performed'
    	    	return $this->throwError('Internal server error, function not performed', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}

/* Article field access commands */

    // {{{ cmdOver()

    /**
     * Fetch message header from message number $first until $last
     *
     * The format of the returned array is:
     * $messages[][header_name]
     *
     * @param optional string $range articles to fetch
     *
     * @return mixed (array) nested array of message and there headers on success or (object) pear_error on failure
     * @access protected
     */
    function cmdOver($range = null)
    {
        if (is_null($range)) {
	    $command = 'OVER';
    	} else {
    	    $command = 'OVER ' . $range;
        }

        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_OVERVIEW_FOLLOWS: // 224, RFC2980: 'Overview information follows'
    	    	$data = $this->_getTextResponse();
    	        if (PEAR::isError($data)) {
    	            return $data;
    	        }

    	        foreach ($data as $key => $value) {
    	            $data[$key] = explode("\t", trim($value));
    	        }

    	    	return $data;
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_GROUP_SELECTED: // 412, RFC2980: 'No news group current selected'
    	    	return $this->throwError('No news group current selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_ARTICLE_SELECTED: // 420, RFC2980: 'No article(s) selected'
    	    	return $this->throwError('No article(s) selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_SUCH_ARTICLE_NUMBER: // 423:, Draft27: 'No articles in that range'
    	    	return $this->throwError('No articles in that range', $response, $this->_currentStatusResponse());
    	    	break;
    	    case 502: // RFC2980: 'no permission'
    	    	return $this->throwError('No permission', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }
    
    // }}}
    // {{{ cmdXOver()

    /**
     * Fetch message header from message number $first until $last
     *
     * The format of the returned array is:
     * $messages[message_id][header_name]
     *
     * @param optional string $range articles to fetch
     *
     * @return mixed (array) nested array of message and there headers on success or (object) pear_error on failure
     * @access protected
     */
    function cmdXOver($range = null)
    {
	// deprecated API (the code _is_ still in alpha state)
    	if (func_num_args() > 1 ) {
    	    die('The second parameter in cmdXOver() has been deprecated! Use x-y instead...');
        }

        if (is_null($range)) {
	    $command = 'XOVER';
    	} else {
    	    $command = 'XOVER ' . $range;
        }

        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_OVERVIEW_FOLLOWS: // 224, RFC2980: 'Overview information follows'
    	    	$data = $this->_getTextResponse();
    	        if (PEAR::isError($data)) {
    	            return $data;
    	        }

    	        foreach ($data as $key => $value) {
    	            $data[$key] = explode("\t", trim($value));
    	        }

    	    	return $data;
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_GROUP_SELECTED: // 412, RFC2980: 'No news group current selected'
    	    	return $this->throwError('No news group current selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_ARTICLE_SELECTED: // 420, RFC2980: 'No article(s) selected'
    	    	return $this->throwError('No article(s) selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case 502: // RFC2980: 'no permission'
    	    	return $this->throwError('No permission', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }
    
    // }}}
    // {{{ cmdListOverviewFmt()

    /**
     * Returns a list of avaible headers which are send from newsserver to client for every news message
     *
     * @return mixed (array) of header names on success or (object) pear_error on failure
     * @access protected
     */
    function cmdListOverviewFmt()
    {
    	$response = $this->_sendCommand('LIST OVERVIEW.FMT');
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_GROUPS_FOLLOW: // 215, RFC2980: 'information follows'
    	    	$data = $this->_getTextResponse();
    	        if (PEAR::isError($data)) {
    	            return $data;
    	        }

    	        $format = array();

    	        foreach ($data as $line) {

		    // Check if postfixed by ':full' (case-insensitive)
		    if (0 == strcasecmp(substr($line, -5, 5), ':full')) {
    	    		// ':full' is _not_ included in tag, but value set to true
    	    		$format[substr($line, 0, -5)] = true;
		    } else {
    	    		// ':' is _not_ included in tag; value set to false
    	    		$format[substr($line, 0, -1)] = false;
    	            }
    	        }

    	        return $format;
    	    	break;
    	    case 503: // RFC2980: 'program error, function not performed'
    	    	return $this->throwError('Internal server error, function not performed', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdXHdr()

    /**
     * 
     *
     * The format of the returned array is:
     * $messages[message_id]
     *
     * @param optional string $field 
     * @param optional string $range articles to fetch
     *
     * @return mixed (array) nested array of message and there headers on success or (object) pear_error on failure
     * @access protected
     */
    function cmdXHdr($field, $range = null)
    {
        if (is_null($range)) {
	    $command = 'XHDR ' . $field;
    	} else {
    	    $command = 'XHDR ' . $field . ' ' . $range;
        }

        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case 221: // 221, RFC2980: 'Header follows'
    	    	$data = $this->_getTextResponse();
    	        if (PEAR::isError($data)) {
    	            return $data;
    	        }

    	    	$return = array();
    	        foreach($data as $line) {
    	    	    $line = explode(' ', trim($line), 2);
    	    	    $return[$line[0]] = $line[1];
    	        }

    	    	return $return;
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_GROUP_SELECTED: // 412, RFC2980: 'No news group current selected'
    	    	return $this->throwError('No news group current selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_ARTICLE_SELECTED: // 420, RFC2980: 'No current article selected'
    	    	return $this->throwError('No current article selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case 430: // 430, RFC2980: 'No such article'
    	    	return $this->throwError('No such article', $response, $this->_currentStatusResponse());
    	    	break;
    	    case 502: // RFC2980: 'no permission'
    	    	return $this->throwError('No permission', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }
    
    // }}}


















    /**
     * Fetches a list of (all) avaible newsgroup descriptions.
     * Depresated as of RFC2980.
     *
     * @param string $wildmat Wildmat of the groups, that is to be listed, defaults to '*';
     *
     * @return mixed (array) nested array with description of existing newsgroups on success or (object) pear_error on failure
     * @access protected
     */
    function cmdXGTitle($wildmat = '*')
    {
        $response = $this->_sendCommand('XGTITLE '.$wildmat);
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case 282: // RFC2980: 'list of groups and descriptions follows'
    	    	$data = $this->_getTextResponse();
    	        if (PEAR::isError($data)) {
    	            return $data;
    	        }

    	    	$groups = array();

    	        foreach($data as $line) {
    	            preg_match("/^(.*?)\s(.*?$)/", trim($line), $matches);
    	            $groups[$matches[1]] = (string) $matches[2];
    	        }

    	        return $groups;
    	    	break;
		  
    	    case 481: // RFC2980: 'Groups and descriptions unavailable'
    	    	return $this->throwError('Groups and descriptions unavailable', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}
    // {{{ cmdXROver()

    /**
     * Fetch message references from message number $first to $last
     *
     * @param optional string $range articles to fetch
     *
     * @return mixed (array) assoc. array of message references on success or (object) pear_error on failure
     * @access protected
     */
    function cmdXROver($range = null)
    {
	// Warn about deprecated API (the code _is_ still in alpha state)
    	if (func_num_args() > 1 ) {
    	    die('The second parameter in cmdXROver() has been deprecated! Use x-y instead...');
    	}

        if (is_null($range)) {
    	    $command = 'XROVER';
    	} else {
    	    $command = 'XROVER ' . $range;
        }

        $response = $this->_sendCommand($command);
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_OVERVIEW_FOLLOWS: // 224, RFC2980: 'Overview information follows'
    	    	$data = $this->_getTextResponse();
    	        if (PEAR::isError($data)) {
    	            return $data;
    	        }

    	    	$return = array();
    	        foreach($data as $line) {
    	    	    $line = explode(' ', trim($line), 2);
    	    	    $return[$line[0]] = $line[1];
    	        }
    	    	return $return;
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_GROUP_SELECTED: // 412, RFC2980: 'No news group current selected'
    	    	return $this->throwError('No news group current selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case NET_NNTP_PROTOCOL_RESPONSECODE_NO_ARTICLE_SELECTED: // 420, RFC2980: 'No article(s) selected'
    	    	return $this->throwError('No article(s) selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case 502: // RFC2980: 'no permission'
    	    	return $this->throwError('No permission', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }

    // }}}




    // {{{ cmdXPat()

    /**
     * 
     *
     * @param string $field 
     * @param string $range
     * @param mixed $wildmat
     *
     * @return mixed (array) nested array of message and there headers on success or (object) pear_error on failure
     * @access protected
     */
    function cmdXPat($field, $range, $wildmat)
    {
        if (is_array($wildmat)) {
	    $wildmat = implode(' ', $wildmat);
    	}

        $response = $this->_sendCommand('XPAT ' . $field . ' ' . $range . ' ' . $wildmat);
        if (PEAR::isError($response)){
            return $response;
        }

    	switch ($response) {
    	    case 221: // 221, RFC2980: 'Header follows'
    	    	$data = $this->_getTextResponse();
    	        if (PEAR::isError($data)) {
    	            return $data;
    	        }

    	    	$return = array();
    	        foreach($data as $line) {
    	    	    $line = explode(' ', trim($line), 2);
    	    	    $return[$line[0]] = $line[1];
    	        }

    	    	return $return;
    	    	break;
    	    case 430: // 430, RFC2980: 'No such article'
    	    	return $this->throwError('No current article selected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case 502: // RFC2980: 'no permission'
    	    	return $this->throwError('No permission', $response, $this->_currentStatusResponse());
    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }
    
    // }}}
    // {{{ cmdAuthinfo()

    /**
     * Authenticate using 'original' method
     *
     * @param string $user The username to authenticate as.
     * @param string $pass The password to authenticate with.
     *
     * @return mixed (bool) true on success or (object) pear_error on failure 
     * @access protected
     */
    function cmdAuthinfo($user, $pass)
    {
    	// Send the username
        $response = $this->_sendCommand('AUTHINFO user '.$user);
        if (PEAR::isError($response)) {
            return $response;
    	}

    	// Send the password, if the server asks
    	if (($response == 381) && ($pass !== null)) {
    	    // Send the password
            $response = $this->_sendCommand('AUTHINFO pass '.$pass);
    	    if (PEAR::isError($response)) {
    	    	return $response;
    	    }
    	}

        switch ($response) {
    	    case 281: // RFC2980: 'Authentication accepted'

	    	// TODO: Set some variable before return

    	        return true;
    	        break;
    	    case 381: // RFC2980: 'More authentication information required'
    	        return $this->throwError('Authentication uncompleted', $response, $this->_currentStatusResponse());
    	        break;
    	    case 482: // RFC2980: 'Authentication rejected'
    	    	return $this->throwError('Authentication rejected', $response, $this->_currentStatusResponse());
    	    	break;
    	    case 502: // RFC2980: 'No permission'
    	    	return $this->throwError('Authentication rejected', $response, $this->_currentStatusResponse());
    	    	break;
//    	    case 500:
//    	    case 501:
//    	    	return $this->throwError('Authentication failed', $response, $this->_currentStatusResponse());
//    	    	break;
    	    default:
    	    	return $this->_handleUnexpectedResponse($response);
    	}
    }
	
    // }}}
    // {{{ cmdAuthinfoSimple()

    /**
     * Authenticate using 'simple' method
     *
     * @param string $user The username to authenticate as.
     * @param string $pass The password to authenticate with.
     *
     * @return mixed (bool) true on success or (object) pear_error on failure 
     * @access protected
     */
    function cmdAuthinfoSimple($user, $pass)
    {
        return $this->throwError("The auth mode: 'simple' is has not been implemented yet", null);
    }
	
    // }}}
    // {{{ cmdAuthinfoGeneric()

    /**
     * Authenticate using 'generic' method
     *
     * @param string $user The username to authenticate as.
     * @param string $pass The password to authenticate with.
     *
     * @return mixed (bool) true on success or (object) pear_error on failure 
     * @access protected
     */
    function cmdAuthinfoGeneric($user, $pass)
    {
        return $this->throwError("The auth mode: 'generic' is has not been implemented yet", null);
    }
	
    // }}}
    // {{{ _isConnected()

    /**
     * Test whether we are connected or not.
     *
     * @return bool true or false
     * @access protected
     */
    function _isConnected()
    {
    	return (is_resource($this->_socket->fp) && (!$this->_socket->eof()));
    }

    // }}}

}

// }}}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */

?>
