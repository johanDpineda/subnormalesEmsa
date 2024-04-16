<style>
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #fff;
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #preloader img{
        width: 25%;
    }
</style>
<div id="preloader">
    <img src="{{ asset('assets/img/logo-emsa.png') }}" alt="Preloader GIF">
</div>
<script>
    window.addEventListener('load', function () {
        var preloader = document.getElementById('preloader');

        function hidePreloader() {
            // console.log('Hide preloader');
            preloader.style.display = 'none';
        }

        if (document.readyState === 'complete') {
            hidePreloader();
        } else {
            window.addEventListener('load', hidePreloader);
        }
    });
</script>
