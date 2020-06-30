<nav class="navbar navbar-expand-lg navbar-light bg-light navAdmin">
  <a class="navbar-brand" href={{route('home')}}>Ecolife</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href={{route('adminCategory')}}>Danh mục sản phẩm</a>
      <a class="nav-item nav-link" href={{route('adminProduct')}}>Sản phẩm</a>
      <a class="nav-item nav-link" href={{route('adminMember')}}>Thành viên</a>
      <a class="nav-item nav-link" href={{route('adminComment')}}>Bình luận</a>
      <a class="nav-item nav-link" href={{route('adminBill')}}>Hóa đơn</a>
    </div>
  </div>
</nav>