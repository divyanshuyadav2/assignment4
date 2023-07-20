@extends('layouts.header')

@section('content')

<div class="container st1" style="width: 700.8px;">
    <h1>Multiple Laravel App Support with one docker Image</h1>
    <div class="csec">
        <div class="profile">
            <img src="image/asset 1.png" alt="">

        </div>
        <div class="name">
            <li>AravSrivastav <a href=""><span class="follow">Follow</span></a></li>
            <li>2 min read. June 28</li>
        </div>
    </div>
    <div class="isec">
        <div>
            <img src="image/asset 33.svg" alt="">
            <img src="image/asset 34.svg" alt="">
        </div>
        <div>
            <img src="image/asset 35.svg" alt="">
            <img src="image/asset 36.svg" alt="">
            <img src="image/asset 37.svg" alt="">

        </div>
    </div>
    <p>If anyone is willing to set up multiple PHP/Laravel projects with Docker, then this article should be the one-stop solution.</p>
    <br>
    <p>Create a Dockerfile add below code</p>
    <br>

    <div class="content-box1">
        <span id="3934" class="lt lu ev lq b bf lv lw l lx ly" data-selectable-paragraph=""><span class="hljs-comment"># Use the official PHP image as the base image</span><br>FROM php:8.2-apache<br><br><span class="hljs-comment"># Set the working directory inside the container</span><br>WORKDIR /var/www/html<br><br><span class="hljs-comment"># Install dependencies</span><br>ARG WWWGROUP<br><br>RUN apt-get update &amp;&amp; \<br> apt-get install -y \<br> git \<br> zip \<br> unzip \<br> libzip-dev<br>RUN curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer <br><span class="hljs-comment"># Install PHP extensions</span><br>RUN docker-php-ext-install pdo_mysql zip<br><br><span class="hljs-comment"># Enable Apache Rewrite module</span><br>RUN a2enmod rewrite<br><br><span class="hljs-comment"># Set the Apache document root</span><br>RUN sed -i <span class="hljs-string">'s!/var/www/html!/var/www/html/public!g'</span> /etc/apache2/sites-available/000-default.conf<br><br><span class="hljs-comment"># Copy the entrypoint script</span><br>COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint<br>COPY start-container /usr/local/bin/start-container<br><br>RUN <span class="hljs-built_in">chmod</span> +x /usr/local/bin/docker-entrypoint<br><br>RUN <span class="hljs-built_in">chown</span> -R www-data:www-data /var/www/html<br>RUN <span class="hljs-built_in">chmod</span> +x /usr/local/bin/start-container<br><span class="hljs-comment"># Expose port 80 for Apache</span><br>EXPOSE 80<br><br><span class="hljs-comment"># Set the entrypoint command</span><br>ENTRYPOINT [<span class="hljs-string">"docker-entrypoint"</span>]</span>

    </div>
    <p>Set environment-specific configurations using this, add <strong>docker- <br>entrypoint.sh</strong></p>
    <div class="content-box1">
        <span id="cd80" class="lt lu ev lq b bf lv lw l lx ly" data-selectable-paragraph=""><span class="hljs-meta">#!/bin/bash</span><br><br><span class="hljs-comment"># Set environment-specific configurations here</span><br><br><span class="hljs-comment"># Start Apache in the foreground</span><br>apache2-foreground</span>
    </div>
    <p>
        Add script for startup script used within a Docker container so create a file <br> <strong>start-container</strong> for this
    </p>
    <div class="content-box1">
        <span id="994c" class="lt lu ev lq b bf lv lw l lx ly" data-selectable-paragraph=""><span class="hljs-meta">#!/usr/bin/env bash</span><br><br><span class="hljs-keyword">if</span> [ ! -z <span class="hljs-string">"<span class="hljs-variable">$WWWUSER</span>"</span> ]; <span class="hljs-keyword">then</span><br> usermod -u <span class="hljs-variable">$WWWUSER</span> sail<br><span class="hljs-keyword">fi</span><br><br><span class="hljs-keyword">if</span> [ ! -d /.composer ]; <span class="hljs-keyword">then</span><br> <span class="hljs-built_in">mkdir</span> /.composer<br><span class="hljs-keyword">fi</span><br><br><span class="hljs-built_in">chmod</span> -R ugo+rw /.composer<br><br><span class="hljs-keyword">if</span> [ <span class="hljs-variable">$#</span> -gt 0 ]; <span class="hljs-keyword">then</span><br> <span class="hljs-built_in">exec</span> gosu <span class="hljs-variable">$WWWUSER</span> <span class="hljs-string">"<span class="hljs-variable">$@</span>"</span><br><span class="hljs-keyword">fi</span></span>
    </div>
    <p>
        Now run the below command to create docker image and tag it with a name
    </p>
    <div class="content-box1">
        <span id="60ea" class="lt lu ev lq b bf lv lw l lz ly" data-selectable-paragraph="">docker image build --tag laravel_web_app -f Dockerfile .</span>
    </div>
    <p>the docker image create with the tag name laravel_web_app, let’s use this for setup multiple Laravel app to different containers you can use this docker-compose file</p>
    <div class="content-box1">
        <span id="4766" class="lt lu ev lq b bf lv lw l lx ly" data-selectable-paragraph=""><span class="hljs-attr">version:</span> <span class="hljs-string">'3'</span><br><br><span class="hljs-attr">services:</span><br> <span class="hljs-attr">example-one:</span><br> <span class="hljs-attr">image:</span> <span class="hljs-string">laravel_web_app</span><br> <span class="hljs-attr">ports:</span><br> <span class="hljs-bullet">-</span> <span class="hljs-number">8000</span><span class="hljs-string">:80</span><br> <span class="hljs-attr">volumes:</span><br> <span class="hljs-comment">#directorypath:/var/www/html</span><br> <span class="hljs-bullet">-</span> <span class="hljs-string">./example-one:/var/www/html</span><br><br> <span class="hljs-attr">example-two:</span><br> <span class="hljs-attr">image:</span> <span class="hljs-string">laravel_web_app</span><br> <span class="hljs-attr">ports:</span><br> <span class="hljs-bullet">-</span> <span class="hljs-number">8001</span><span class="hljs-string">:80</span><br> <span class="hljs-attr">volumes:</span><br> <span class="hljs-comment">#directorypath:/var/www/html</span><br> <span class="hljs-bullet">-</span> <span class="hljs-string">./example-two:/var/www/html</span><br></span>
    </div>
    <p>Now both laravel app will be available, using the same image only.</p>
    <br>
    <p>You can add configuration and the things using checkout in the docker containers</p>

    <div class="content-box1">
        <span id="47b3" class="lt lu ev lq b bf lv lw l lz ly" data-selectable-paragraph="">docker exec -it --user=www-data example-one bash</span>
    </div>
    <div class="b-container">
        <div class="laravel">Laravel</div>
        <div class="laravel">Docker</div>
        <div class="laravel">Laradock</div>
        <div class="laravel">Multi App</div>
        <div class="laravel">Multilaravel</div>

    </div>
    <div class="end">
        <div>
            <img src="image/asset 33.svg" alt="">
            <img src="image/asset 34.svg" alt="">
        </div>
        <div>
            <img src="image/asset 35.svg" alt="">
            <img src="image/asset 37.svg" alt="">

        </div>
    </div>


</div>
<div style="background-color: #F9F9F9;">
    <div class="container btm" style="width: 700.8px;">
        <img src="image/asset 1.png" alt="">
        <div class="end-b">
            <div>
                <h4>Written by Aravsrivastava</h4>
                <br>
                <span>0 Follower</span>

            </div>
            <div>
                <div class="btn2">Follow</div>


            </div>


        </div>
        <div class="nn"></div>
        <h4>Recommended from Medium</h4>
        <div class="card-deck" style="margin-top: 65px;">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="image/asset 3.png" width="324" height="126px" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Think of a Number</h5>
                            <p class="card-text">Why humans and machines are bad at being random</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="image/asset 5.jpeg" width="324" height="126px" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">I Can See Your Lips Moving</h5>
                            <p class="card-text">How your brain combines visual and auditory signals to make </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>

                </div>

            </div>


        </div>
        <div class="card-deck" style="margin-top: 65px;">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="image/asset 23.png" width="324" height="126px" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Think of a Number</h5>
                            <p class="card-text">Why humans and machines are bad at being random</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="image/asset 25.jpeg" width="324" height="126px" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">I Can See Your Lips Moving</h5>
                            <p class="card-text">How your brain combines visual and auditory signals to make </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>

                </div>

            </div>


        </div>


    </div>
</div>
    <style>
        .st1 h1 {
            letter-spacing: -0.011em;
            line-height: 52px;
            margin-bottom: 32px;
            margin-top: 1.19em;
            font-size: 42px;
            font-weight: 700;
            color: #242424;
            font-family: sohne, "Helvetica Neue", Helvetica, Arial, sans-serif;
            word-wrap: break-word;

        }

        a {
            text-decoration: none;
        }

        li {
            list-style-type: none;
        }

        .csec {
            display: flex;
            align-items: center;
            padding: 0px;
            gap: 8px;
        }

        .isec {
            margin-top: 2rem;
            margin-bottom: 3rem;
            display: flex;
            align-items: center;
            padding: 10px;
            justify-content: space-between;
            border-bottom: solid 1px #F2F2F2;
            border-top: solid 1px #F2F2F2;
        }

        .profile img {
            border-radius: 30px;
        }

        .follow {
            color: #1A8917;
        }

        p {
            letter-spacing: -0.003em;
            line-height: 28px;
            font-size: 18px;
            font-family: source-serif-pro, Georgia, Cambria, "Times New Roman", Times, serif;
            letter-spacing: -0.004em;
            color: #242424;
            font-weight: 400;
            word-wrap: break-word
        }

        .content-box1 {
            margin-top: px;
            border: 1px solid #E5E5E5;
            padding: 32px;
            font-family: source-code-pro, Menlo, Monaco, "Courier New", Courier, monospace;
            overflow-x: auto;
            border-radius: 4px;
            background: #F9F9F9;
            box-sizing: inherit;
            word-wrap: break-word;
            font-weight: 400;
            margin-bottom: 3rem;
        }

        .hljs-comment,
        .hljs-quote {
            color: #007400;
        }

        .lx {
            white-space: pre;
        }

        .lu {
            letter-spacing: -0.022em;
        }

        .lt {
            line-height: 1.4;
        }

        .ev {
            font-style: normal;
        }

        .bf {
            font-size: 14px;
        }

        .b {
            font-weight: 400;
        }

        .bj {
            color: #242424;
        }

        .hljs-tag,
        .hljs-attribute,
        .hljs-keyword,
        .hljs-selector-tag,
        .hljs-literal,
        .hljs-name {
            color: #aa0d91;
        }

        .hljs-code,
        .hljs-string,
        .hljs-meta .hljs-string {
            color: #c41a16;
        }

        .hljs-variable,
        .hljs-template-variable {
            color: #3F6E74;
        }

        .laravel {
            white-space: nowrap;
            transition: 300ms ease;
            border-radius: 100px;
            padding: 8px 16px;
            position: relative;
            border: 1px solid #F2F2F2;
            background-color: #F2F2F2;
            color: #242424;
            font-size: 14px;
            line-height: 20px;

            font-family: sohne, "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight: 400;
            cursor: pointer;

        }

        .b-container {
            margin-top: 5rem;
            display: flex;
            gap: 20px;
            margin-bottom: 2rem;
        }

        .end {
            margin-top: 2rem;
            margin-bottom: 3rem;
            display: flex;
            align-items: center;
            padding: 10px;
            justify-content: space-between;
        }

        .btm img {
            margin-top: 6rem;
            margin-bottom: 2rem;
            border-radius: 30px;
        }

        .end-b {
            display: flex;
            justify-content: space-between;
        }

        .btn2 {
            text-decoration: none;
            border-style: solid;
            border-width: 1px;
            width: auto;
            border-radius: 99em;
            border-color: #1A8917;
            background: #1A8917;
            fill: #FFFFFF;
            color: #FFFFFF;
            padding: 8px 16px;
            box-sizing: border-box;
            display: inline-block;
            font-size: 14px;
            line-height: 20px;
            font-weight: 400;
            cursor: pointer;
        }

        .nn {
            margin-top: 40px;
            border-bottom: solid 1px #E5E5E5;
            padding: 10px;
            width: 100%;
            height: 0px;
            font-weight: 400;
            box-sizing: inherit;
            margin-bottom: 5rem;

        }
    </style>
    @stop