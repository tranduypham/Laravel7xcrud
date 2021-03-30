<div>
    <h1>{{ $blog->name }}</h1>
    <p class="intro"><strong>{{ $blog->intro }}</strong></p>
    {!! $blog->content !!}
</div>
<style>
    .show_modal .content p.intro{
        text-indent: 30px;
    }
    .show_modal{
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.384);
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999;
        visibility: hidden;
        transition: visibility 0.5s ease-in-out;
    }
    .show_modal .cancle{
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: white;
        text-align: center;
        padding: 10px;
        box-sizing: border-box;
        position: absolute;
        top: 50px;
        right: 50px;
        font-size: bold;
        color: black;
        box-shadow: inset -1px -1px rgb(100, 100, 100),1px 1px rgb(71, 71, 71);
        cursor: pointer;
    }
    .show_modal .content{
        width: 70%;
        height: 90%;
        background: white;
        border-radius: 30px;
        /* box-shadow: 5px 5px rgba(128, 128, 128, 0.507); */
        border-right: 6px solid rgb(95, 95, 95);
        border-bottom: 5px solid rgb(95, 95, 95);
        overflow: scroll;
        padding: 50px 30px;
    }

    .show_modal .content::-webkit-scrollbar{
        border-radius: 10px;
    }
    .show_modal .content::-webkit-scrollbar-track {
        margin: 30px;
        border-radius: 10px;
    }
    .show_modal .content::-webkit-scrollbar-thumb {
        background: #4e73df;
        border-radius: 10px;
    }
</style>
