// The output below is limited by 4 KB.
// Upgrade your plan to remove this limitation.

//
//  OKWebViewController.m
//  SAML Sample
//
//  Created by Tom Belote on 3/6/14.
//  Copyright (c) 2014 Okta, Inc. All rights reserved.
//
/*
 * SAML related comments are in the "block style" comments (this is a block style comment).
 *
 * See the STEP 1, STEP 1.1, STEP 2, STEP 3, and STEP 4 comments below to understand
 * how to implement a SAML flow in an embedded webView.
 */
/*
 * Replace all instances of the string "EXAMPLE" below with the approprate values for your setup.
 */
let SAML_URL_STRING = "https://EXAMPLE.okta.com/app/salesforce/EXAMPLE/sso/saml"
let SALESFORCE_BASE_URL = "https://EXAMPLE.salesforce.com/"
let LOGIN_SUCCESS_URL_STRING = "https://EXAMPLE.salesforce.com/home/home.jsp"
let SALESFORCE_OAUTH_AUTHORIZE = "https://login.salesforce.com/services/oauth2/authorize?response_type=code&client_id=EXAMPLE&redirect_uri=https://EXAMPLE.okta.com/salesforce/oauth&state=mystate"
/*
 * NEVER include a client secret in an iPhone app.
 * Instead, use a proxy or OAuth service that doesn't require this.
 */
let SALESFORCE_OAUTH = "https://EXAMPLE.salesforce.com/services/oauth2/token?client_id=EXAMPLE&grant_type=authorization_code&redirect_uri=https://EXAMPLE.okta.com/salesforce/oauth&client_secret=EXAMPLE"
let OAUTH_CALLBACK = "https://EXAMPLE.okta.com/salesforce/oauth"
let OKTA_DEMO_LOGIN_URL = "https://EXAMPLE.okta.com/login"

import UIKit

class OKWebViewController: UIViewController, UIWebViewDelegate {
    var done: Bool
    
    
    override init(nibName nibNameOrNil: String!, bundle nibBundleOrNil: NSBundle!) {
        super.init(nibName: nibNameOrNil, bundle: nibBundleOrNil)

    }
    
    required init?(coder aDecoder: NSCoder) {
        fatalError("init(coder:) has not been implemented")
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view.
        self.view.backgroundColor = UIColor.whiteColor()
        var webView: UIWebView = UIWebView(frame: self.view!.bounds)
        /*
         * This needs to be a webView delegate so we know when sign-in is complete.
         */
        webView.delegate = self
        webView.translatesAutoresizingMaskIntoConstraints = false
        self.view!.addSubview(webView)
        var topGuide: AnyObject = self.topLayoutGuide
        var bottomGuide: AnyObject = self.bottomLayoutGuide
        var topViewsDictionary: [NSObject : AnyObject] = NSDictionaryOfVariableBindings(webView, topGuide)
        var bottomViewsDictionary: [NSObject : AnyObject] = NSDictionaryOfVariableBindings(webView, bottomGuide)
        self.view!.addConstraints(NSLayoutConstraint.constraintsWithVisualFormat("V:[topGuide]-0-[webView]", options: [], metrics: nil, views: topViewsDictionary))
        self.view!.addConstraints(NSLayoutConstraint.constraintsWithVisualFormat("V:[webView]-0-[bottomGuide]", options: [], metrics: nil, views: bottomViewsDictionary))
        self.view!.addConstraints(NSLayoutConstraint.constraintsWithVisualFormat("|[webView]|", options: [], metrics: nil, views: NSDictionaryOfVariableBindings(webView)))
        self.view!.layoutSubviews()
        /*
         * STEP 1:
         
         * Load the Okta "chicklet" link in the webView.
         * This will redirect to a login screen and is the start of the SAML flow.
         */
        webView.loadRequest(NSURLRequest(URL: NSURL(string: SAML_URL_STRING)!))
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
        // Dispose of any resources that can be recreated.
    }
    
    func oauthCodeFromURL(urlString: String) -> String {
        var pieces: [AnyObject] = urlString.componentsSeparatedByString("=")
        return pieces[1] as! String
    }
    // MARK: WebViewDelegate
    
    func webViewDidFinishLoad(webView: UIWebView) {
        print("Loaded \(webView.request!.URL!.absoluteString)")
        if !webView.isLoading {
            /*
             * STEP 1.1:
             *
             * For the purposes of this demonstration, we will fill in credentials automatically.
             *
             * DO NOT DO THIS IN A REAL APP.
             *
             */
            if webView.request!.URL!.absoluteString.hasPrefix(OKTA_DEMO_LOGIN_URL) {
                /*
                 * This is just for the purposes of this demonstration, so you know how to login.
                 * Normally the user would type in their username and password or use Okta Mobile Connect to SSO in.
                 */
                webView.stringByEvaluatingJavaScriptFromString("$('#user-signin').val('demo@example.com');$('#pass-signin').val('ExamplePassword');")!
            }
            else if (webView.request!.URL!.absoluteString == LOGIN_SUCCESS_URL_STRING) {
                /*
                 * STEP 2:
                 *
                 * Now that we are signed in to Salesforce, start the OAuth flow so we can get a long lived token,
                 * this way the user won't have to constantly re-enter their password.
                 *
                 //But you could skip the later steps and just use the salesforce session cookies, it is now in the shared cookie jar
                 //here it is logged
                 */
                print("logged in to salesforce with session cookies \(NSHTTPCookieStorage.sharedHTTPCookieStorage().cookiesForURL(NSURL(string: SALESFORCE_BASE_URL)!))")
                var oauthRequest: NSMutableURLRequest = NSMutableURLRequest(URL: NSURL(string: SALESFORCE_OAUTH_AUTHORIZE)!)
                oauthRequest.HTTPMethod = "POST"
                webView.loadRequest(oauthRequest)
            }
        }
    }
    
    func webView(webView: UIWebView, didFailLoadWithError error: NSError?) {
        if webView.request!.URL!.absoluteString.hasPrefix(OAUTH_CALLBACK) || error!.code == -999 {
            return
        }
        var alert: UIAlertView = UIAlertView(title: "Error loading webpage", message: "\(webView.request!.URL!.absoluteString) \(error!.localizedDescription)", delegate: nil, cancelButtonTitle: "OK", otherButtonTitles: "")
        alert.show()
    }
    
    func webView(webView: UIWebView, shouldStartLoadWithRequest request: NSURLRequest, navigationType: UIWebViewNavigationType) -> Bool {
        if request.URL!.absoluteString.hasPrefix(OAUTH_CALLBACK) {
            /*
             * STEP 3:
             *
             * We got the callback from OAuth, now we can use the "code" from the callback URL to request our token.
             */
            print("Got callback \(request.URL!.absoluteString)")
            /*
             * This means we are done.
             */
            if done == false {
                var code: String = self.oauthCodeFromURL(request.URL!.absoluteString)
                var oauthTokenRequest: NSMutableURLRequest = NSMutableURLRequest(URL: NSURL(string: SALESFORCE_OAUTH)!)
                oauthTokenRequest.HTTPMethod = "POST"
                oauthTokenRequest.HTTPBody = "code=\(code)".dataUsingEncoding(NSUTF8StringEncoding)
                done = true
                NSURLConnection.sendAsynchronousRequest(oauthTokenRequest, queue: NSOperationQueue(), completionHandler: {(response: NSURLResponse, data: NSData, connectionError: NSError) -> Void in
