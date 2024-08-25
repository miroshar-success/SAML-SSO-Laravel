<?php

//This is variable is an example - Just make sure that the urls in the 'idp' config are ok.
$idp_host = 'https://laravel-sso.herokuapp.com';

return $settings = array(

    /**
     * If 'useRoutes' is set to true, the package defines five new routes:
     *
     *    Method | URI                      | Name
     *    -------|--------------------------|------------------
     *    POST   | {routesPrefix}/acs       | saml_acs
     *    GET    | {routesPrefix}/login     | saml_login
     *    GET    | {routesPrefix}/logout    | saml_logout
     *    GET    | {routesPrefix}/metadata  | saml_metadata
     *    GET    | {routesPrefix}/sls       | saml_sls
     */
    'useRoutes' => true,

    'routesPrefix' => '/saml2',

    /**
     * which middleware group to use for the saml routes
     * Laravel 5.2 will need a group which includes StartSession
     */
    'routesMiddleware' => [],

    /**
     * Indicates how the parameters will be
     * retrieved from the sls request for signature validation
     */
    'retrieveParametersFromServer' => false,

    /**
     * Where to redirect after logout
     */
    'logoutRoute' => '/',

    /**
     * Where to redirect after login if no other option was provided
     */
    'loginRoute' => '/login',


    /**
     * Where to redirect after login if no other option was provided
     */
    'errorRoute' => '/error',




    /*****
     * One Login Settings
     */



    // If 'strict' is True, then the PHP Toolkit will reject unsigned
    // or unencrypted messages if it expects them signed or encrypted
    // Also will reject the messages if not strictly follow the SAML
    // standard: Destination, NameId, Conditions ... are validated too.
    'strict' => true, //@todo: make this depend on laravel config

    // Enable debug mode (to print errors)
    'debug' => false, //@todo: make this depend on laravel config,

    // If 'proxyVars' is True, then the Saml lib will trust proxy headers
    // e.g X-Forwarded-Proto / HTTP_X_FORWARDED_PROTO. This is useful if
    // your application is running behind a load balancer which terminates
    // SSL.
    'proxyVars' => false,

    // Service Provider Data that we are deploying
    'sp' => array(

        // Specifies constraints on the name identifier to be used to
        // represent the requested subject.
        // Take a look on lib/Saml2/Constants.php to see the NameIdFormat supported
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',

        // Usually x509cert and privateKey of the SP are provided by files placed at
        // the certs folder. But we can also provide them with the following parameters
        'x509cert' => '',
        'privateKey' => '',

        // Identifier (URI) of the SP entity.
        // Leave blank to use the 'saml_metadata' route.
        'entityId' => $idp_host . '/saml2/metadata',

        // Specifies info about where and how the <AuthnResponse> message MUST be
        // returned to the requester, in this case our SP.
        'assertionConsumerService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-POST binding.
            // Leave blank to use the 'saml_acs' route
            'url' => $idp_host . '/saml2/acs',
        ),
        // Specifies info about where and how the <Logout Response> message MUST be
        // returned to the requester, in this case our SP.
        // Remove this part to not include any URL Location in the metadata.
        'singleLogoutService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-Redirect binding.
            // Leave blank to use the 'saml_sls' route
            'url' => $idp_host . '/saml2/sls',
        ),
    ),

    // Identity Provider Data that we want connect with our SP
    'idp' => array(
        // Identifier of the IdP entity  (must be a URI)
        'entityId' => 'https://app.onelogin.com/saml/metadata/735068',
        // SSO endpoint info of the IdP. (Authentication Request protocol)
        'singleSignOnService' => array(
            // URL Target of the IdP where the SP will send the Authentication Request Message,
            // using HTTP-Redirect binding.
            'url' => 'https://west-agile-labs-dev.onelogin.com/trust/saml2/http-post/sso/735068',
        ),
        // SLO endpoint info of the IdP.
        'singleLogoutService' => array(
            // URL Location of the IdP where the SP will send the SLO Request,
            // using HTTP-Redirect binding.
            'url' => 'https://west-agile-labs-dev.onelogin.com/trust/saml2/http-redirect/slo/735068',
        ),
        // Public x509 certificate of the IdP
        'x509cert' => 'MIIELzCCAxegAwIBAgIUcvbiroRY3uCDSGEiBA0SEbS99zswDQYJKoZIhvcNAQEF
BQAwYDELMAkGA1UEBhMCVVMxGDAWBgNVBAoMD1dlc3QgQWdpbGUgTGFiczEVMBMG
A1UECwwMT25lTG9naW4gSWRQMSAwHgYDVQQDDBdPbmVMb2dpbiBBY2NvdW50IDEx
OTAxNzAeFw0xNzEyMDgwNjQyMjlaFw0yMjEyMDgwNjQyMjlaMGAxCzAJBgNVBAYT
AlVTMRgwFgYDVQQKDA9XZXN0IEFnaWxlIExhYnMxFTATBgNVBAsMDE9uZUxvZ2lu
IElkUDEgMB4GA1UEAwwXT25lTG9naW4gQWNjb3VudCAxMTkwMTcwggEiMA0GCSqG
SIb3DQEBAQUAA4IBDwAwggEKAoIBAQCl/1zViwRwhxZcC64AEvzglKkUHAIWVS4K
EjiBGtMGmR/OAE1z8+so50SD2SvNsP6AL1xLo2hRvWAo4hUZb+94Q6hZunX29L8B
jjWVH+pxX0/MwTrEE2nByWWd407ENvDZEaqJXxkcG4u0eTreicOhwfBO1z6tIFIE
xo5G6VjpZ//4se3aou/jlRqTMcA1aRJe0qB8wl7eVvnOaweoyundvPlCdGy4/XYu
sIVbtA/YHwDIe75cYYVLavNfrIb0mOGVc8P1MPoSaIc10Mh1ZdQ4c+8suQr365u8
0uykf7DpQEaF6viWngrATXOwrFXhvgxx19opWcku+o3+HyqTJH51AgMBAAGjgeAw
gd0wDAYDVR0TAQH/BAIwADAdBgNVHQ4EFgQUTnN4zUcJi8AGs1HbpC2EZBKbN7Ew
gZ0GA1UdIwSBlTCBkoAUTnN4zUcJi8AGs1HbpC2EZBKbN7GhZKRiMGAxCzAJBgNV
BAYTAlVTMRgwFgYDVQQKDA9XZXN0IEFnaWxlIExhYnMxFTATBgNVBAsMDE9uZUxv
Z2luIElkUDEgMB4GA1UEAwwXT25lTG9naW4gQWNjb3VudCAxMTkwMTeCFHL24q6E
WN7gg0hhIgQNEhG0vfc7MA4GA1UdDwEB/wQEAwIHgDANBgkqhkiG9w0BAQUFAAOC
AQEAhdpLf8Juo7NqvgylEVmNmnHLehntskrpZnBDTVkJrYOcepXyufc2yijS4YbO
DWFj5XQPZ0nslDnzITPtM1FVfuior1GFWEQbhN0VSwRsHwryMzeeetT/F1zPfyri
IwKO9gsvKMTVsQBPOGEvQcheuyUcQIlwmCozAcCfgyP/63Pqn1QEHnYH7SBhrlGv
5u6gGeJrEQtkSWqAFrOrVx9y4Ij6sbXqDqbBVG7m4qP1vLcJ/cnWKrUUw2Z244uD
9rVQvEk0jc8QaKICqnIErLBBkdeTyq3tWlnzYAW+In1t6+0qSsMNgGsY9wYSV65r
OUHpWSvt5nX9bQQeP9gafKytTw==',
        /*
         *  Instead of use the whole x509cert you can use a fingerprint
         *  (openssl x509 -noout -fingerprint -in "idp.crt" to generate it)
         */
        // 'certFingerprint' => '',
    ),



    /***
     *
     *  OneLogin advanced settings
     *
     *
     */
    // Security settings
    'security' => array(

        /** signatures and encryptions offered */

        // Indicates that the nameID of the <samlp:logoutRequest> sent by this SP
        // will be encrypted.
        'nameIdEncrypted' => false,

        // Indicates whether the <samlp:AuthnRequest> messages sent by this SP
        // will be signed.              [The Metadata of the SP will offer this info]
        'authnRequestsSigned' => false,

        // Indicates whether the <samlp:logoutRequest> messages sent by this SP
        // will be signed.
        'logoutRequestSigned' => false,

        // Indicates whether the <samlp:logoutResponse> messages sent by this SP
        // will be signed.
        'logoutResponseSigned' => false,

        /* Sign the Metadata
         False || True (use sp certs) || array (
                                                    keyFileName => 'metadata.key',
                                                    certFileName => 'metadata.crt'
                                                )
        */
        'signMetadata' => false,


        /** signatures and encryptions required **/

        // Indicates a requirement for the <samlp:Response>, <samlp:LogoutRequest> and
        // <samlp:LogoutResponse> elements received by this SP to be signed.
        'wantMessagesSigned' => false,

        // Indicates a requirement for the <saml:Assertion> elements received by
        // this SP to be signed.        [The Metadata of the SP will offer this info]
        'wantAssertionsSigned' => false,

        // Indicates a requirement for the NameID received by
        // this SP to be encrypted.
        'wantNameIdEncrypted' => false,

        // Authentication context.
        // Set to false and no AuthContext will be sent in the AuthNRequest,
        // Set true or don't present thi parameter and you will get an AuthContext 'exact' 'urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport'
        // Set an array with the possible auth context values: array ('urn:oasis:names:tc:SAML:2.0:ac:classes:Password', 'urn:oasis:names:tc:SAML:2.0:ac:classes:X509'),
        'requestedAuthnContext' => true,
    ),

    // Contact information template, it is recommended to suply a technical and support contacts
    'contactPerson' => array(
        'technical' => array(
            'givenName' => 'name',
            'emailAddress' => 'no@reply.com'
        ),
        'support' => array(
            'givenName' => 'Support',
            'emailAddress' => 'no@reply.com'
        ),
    ),

    // Organization information template, the info in en_US lang is recomended, add more if required
    'organization' => array(
        'en-US' => array(
            'name' => 'Name',
            'displayname' => 'Display Name',
            'url' => 'https://url'
        ),
    ),

/* Interoperable SAML 2.0 Web Browser SSO Profile [saml2int]   http://saml2int.org/profile/current

   'authnRequestsSigned' => false,    // SP SHOULD NOT sign the <samlp:AuthnRequest>,
                                      // MUST NOT assume that the IdP validates the sign
   'wantAssertionsSigned' => true,
   'wantAssertionsEncrypted' => true, // MUST be enabled if SSL/HTTPs is disabled
   'wantNameIdEncrypted' => false,
*/

);
