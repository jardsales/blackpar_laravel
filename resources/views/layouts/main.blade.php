<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <meta name="viewport" content="width=device-width, user-scalable=no"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300&display=swap" rel="stylesheet">
    <title>@yield("title")</title>
    <style>
    html {
        background: #e0e0e0;
        padding: 15px;
    }
    * {
        font-family: 'Fira Sans', sans-serif;
    }
    .content {
        width: 800px;
        max-width: 100%;
        background: #FFF;
        margin: 20px auto;
        padding: 15px;
        box-shadow:0px 0px 15px 2px rgba(0, 0, 0, 0.2);
    }
    .animate-fade-in {
        animation: fadein 1s;
    }
    @keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
    .navbar1 {
        flex-grow: 1;
        display: flex;
        align-items: center;
    }
    .navbar1 a {
        color: #363636;
    }
    .navbar1 .menu a {
        padding-left: 15px;
    }
    .navbar1 .menu a:hover {
        color: #485fc7;
    }
    .navbar1 .end {
        flex-grow:1;
        display: flex;
        justify-content: flex-end;
    }
    .body {
        padding: 10px;
        margin: 20px 0px;
    }
    .divider {
        border-bottom: 1px solid #CECECE;
    }
    .preloadergif {
        width: 45px;
        height: 45px;
        margin: 0 auto;
    }
    .yt-videos-box {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 1fr);
        grid-column-gap: 10px;
        grid-row-gap: 10px;
    }
    .yt-videos-box img {
        height: 180px;
        width: auto;
    }
    .yt-videos-box a {
        color: #363636;
    }
    .yt-video-item {
        border: 1px solid #DBDBDB;
        box-shadow: 0px 0px 5px 2px rgb(0 0 0 / 10%);
        padding: 15px;
        font-size: 1.2em;
        font-weight: bold;
        cursor: pointer;
    }
    .yt-video-item em {
        font-weight: normal;
    }
    .channelTitle {
        font-size: 1em;
        font-weight: normal;
    }
    img.circle {
        border-radius: 50%;
    }
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    
    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
    
    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    .nresField {
        max-width: 150px;
    }
    .nresFieldBox {
        width: 100%;
        display: flex;
        justify-content: flex-end;
    }
</style>
</head>

<body>
    <div class="content">
        @yield("content")
    </div>
</body>
</html>