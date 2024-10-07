<?php

namespace HBP_Disabler_Vendor\Hybrid\Contracts;

interface Responsable
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Hybrid\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request);
}
