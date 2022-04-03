<div class="nav-left text-center mt-4">
    <img src="{{url('Assets/Icon/logo.png')}}" class="logo">

    <button id="btnToggleMenuLeft" class="toggleMenuLeft">
        <i class="fa fa-bars ic-open show"></i>
        <img class="ic-close hide" src="{{url('Assets/Icon/icon - close.png')}}">
    </button>

    <div class="back-to-top">
        <a id="backToTop" href="#"><b>Back To Top <img src="{{url('Assets/Icon/icon - arrow.png')}}"></b></a>
    </div>

    <div id="navExpand" class="nav-expand hide">
        <nav class="nav">
            <a class="nav-link" href="#">News</a>
            <a class="nav-link" href="#">Recipe</a>
            <a class="nav-link" href="#">Find Us</a>
            <a class="nav-link" href="#">About Us</a>
            <a class="nav-link" href="#">Contact Us!</a>
        </nav>

        <div class="language">
            <select class="choose-languange">
                <option>English</option>
                <option>Indonesia</option>
            </select>
        </div>
    </div>
</div>

@push('scripts')
<script>
var isShow = false;
$("#btnToggleMenuLeft").click(function (e) { 
    e.preventDefault();
    $navExpand = $('#navExpand');
    $icClose = $('.ic-close');
    $icOpen = $('.ic-open');
    $toggleMenuLeft = $('.toggleMenuLeft');

    $navExpand.toggle(); 
        console.log("isShow", isShow);
    if(isShow){
        console.log("isShow:true");
        isShow = false;
        $icClose.hide();
        $icOpen.show();
        $toggleMenuLeft.css('background', '#97C455');
    }else if(!isShow){
        console.log("isShow:false");
        isShow = true;
        $icClose.show();
        $icOpen.hide();
        $toggleMenuLeft.css('background', 'unset');
        
    }
});

$("#backToTop").click(function (e) { 
    e.preventDefault();
    var body = $("html, body");
    body.stop().animate({scrollTop:0}, 500, 'swing', function() { });
});
</script>
@endpush