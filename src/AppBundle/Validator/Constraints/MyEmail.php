<?php
/**
 * Created by PhpStorm.
 * User: deve_
 * Date: 31/10/2017
 * Time: 17:47
 */
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraints\Email;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class MyEmail extends Email
{
    const INVALID_FORMAT_ERROR = 'bd79c0ab-ddba-46cc-a703-a7a4b08de310';
    const MX_CHECK_FAILED_ERROR = 'bf447c1c-0266-4e10-9c6c-573df282e413';
    const HOST_CHECK_FAILED_ERROR = '7da53a8b-56f3-4288-bb3e-ee9ede4ef9a1';

    protected static $errorNames = array(
        self::INVALID_FORMAT_ERROR => 'STRICT_CHECK_FAILED_ERROR',
        self::MX_CHECK_FAILED_ERROR => 'MX_CHECK_FAILED_ERROR',
        self::HOST_CHECK_FAILED_ERROR => 'HOST_CHECK_FAILED_ERROR',
    );

    public $message = 'La valeur de cet Email n\'est pas valide.';
    public $checkMX = false;
    public $checkHost = false;
    public $strict;
}
