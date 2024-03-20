<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:700');

    #unique-container #container > div {
        color: blue;
        text-transform: uppercase;
        font-size: 40px;
        font-weight: bold;
        background-image: url("assets/images/shopcart.gif");
        background-size: 400px 200px; /* or 'contain' based on your preference */
        background-position: center;
        border-radius: 10px;
        width: 100%;
        height: 220px;
        bottom: 45%;
        display: block;
    }

    #unique-container #flip {
        height: 50px;
        overflow: hidden;
    }

    #unique-container #flip > div > div {
        color: #fff;
        padding: 4px 12px;
        height: 50px;
        margin-bottom: 40px;
        display: inline-block;
    }

    #unique-container #flip div:first-child {
        animation: show 10s linear infinite;
    }

    #unique-container #flip div div {
        background: #42c58a;
    }

    #unique-container #flip div:first-child div {
        background: #4ec7f3;
    }

    #unique-container #flip div:last-child div {
        background: #DC143C;
    }

    @keyframes show {
        0% {
            margin-top: -270px;
        }

        5% {
            margin-top: -180px;
        }

        33% {
            margin-top: -180px;
        }

        38% {
            margin-top: -90px;
        }

        66% {
            margin-top: -90px;
        }

        71% {
            margin-top: 0px;
        }

        99.99% {
            margin-top: 0px;
        }

        100% {
            margin-top: -270px;
        }
    }

    #unique-container p {
        
        width: 100%;
        bottom: 30px;
        font-size: 12px;
        color: #999;
        
    }
</style>

<div id="unique-container">
    <div id="container" >
        <div style="padding-top: 20px;">
            Shop
            <div id="flip">
                <div><div>Efficiently</div></div>
                <div><div>Faster</div></div>
                <div><div>With Us</div></div>
            </div>
            Now!
        </div>
    </div>
</div>
