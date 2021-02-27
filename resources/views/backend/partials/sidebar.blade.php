<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion col-md-2" id="accordionSidebar">

    <div style="">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url("/backend/product/index")}}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            {{-- Để khi nhấn search cái là auto bay về trang 1 luôn bằng biến page=1 😀--}}
            <input type="hidden" name="page" value="2">
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{url("/backend/product/index")}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Shopping</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Shop
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("/backend/product/index")}}" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Sản phẩm</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Chức năng chính:</h6>
                    <a class="collapse-item" href="{{url("/backend/product/create")}}">Create</a>
                    <a class="collapse-item" href="{{url("/backend/product/index")}}">Index</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url("/product/catagory")}}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Danh mục</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route("orders.index")}}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Đơn hàng</span>
            </a>
        </li>
    </div>

</ul>
