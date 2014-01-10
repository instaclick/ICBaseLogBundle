<?php
/**
 * @copyright 2013 Instaclick Inc.
 */

namespace IC\Bundle\Base\LogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * JavaScript error controller
 *
 * @author Kinn Coelho Julião <kinnj@nationalfibre.net>
 */
class JavaScriptErrorController extends Controller
{
    /**
     * Create a log entry
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response $response
     */
    public function createAction(Request $request)
    {
        $logService    = $this->get('ic_base_log.service.javascript_error_service');
        $parameterList = array(
            "file"      => $request->get('file'),
            "line"      => $request->get('line'),
            "message"   => $request->get('message'),
            "url"       => $request->get('url'),
            "userAgent" => $request->get('userAgent'),
        );

        $logService->write($parameterList);

        $response = new Response(
            base64_decode('R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='),
            200,
            array('content-type' => 'image/gif')
        );

        return $response;
    }
}
