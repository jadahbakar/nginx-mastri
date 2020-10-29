@extends('layout.admin')

@section('content')
    <div class="content-header row"></div>
    <div class="content-body">
        <!-- eCommerce statistic -->
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="info">{!! $var['jum_skpd'] !!}</h3>
                                    <h6>SKPD</h6>
                                </div>
                                <div>
                                    <i class="icon-rocket info font-large-2 float-right"></i>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="warning">{!! $var['jum_kode_akun'] !!}</h3>
                                    <h6>Kode Akun</h6>
                                </div>
                                <div>
                                    <i class="icon-social-dropbox warning font-large-2 float-right"></i>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="success">{!! $var['jum_pengguna'] !!}</h3>
                                    <h6>Pengguna</h6>
                                </div>
                                <div>
                                    <i class="icon-user-follow success font-large-2 float-right"></i>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="danger">{!! $var['jum_kode_kegiatan'] !!}</h3>
                                    <h6>Kegiatan</h6>
                                </div>
                                <div>
                                    <i class="icon-grid danger font-large-2 float-right"></i>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ eCommerce statistic -->
        <!-- Image grid -->
        <section id="image-gallery" class="card">
            <div class="card-header">
                <h4 class="card-title">Galeri</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            </div>
            <div class="card-content">
                <div class="card-body  my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
                    <div class="row">
                        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                            <a href="{{ url('my-assets/gambar/galeri/gambar-1.jpg') }}" itemprop="contentUrl" data-size="480x360">
                                <img class="img-thumbnail img-fluid" src="{{ url('my-assets/gambar/galeri/gambar-1.jpg') }}" itemprop="thumbnail" alt="Image description" />
                            </a>
                        </figure>
                        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                            <a href="{{ url('my-assets/gambar/galeri/gambar-2.jpg') }}" itemprop="contentUrl" data-size="480x360">
                                <img class="img-thumbnail img-fluid" src="{{ url('my-assets/gambar/galeri/gambar-2.jpg') }}" itemprop="thumbnail" alt="Image description" />
                            </a>
                        </figure>
                        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                            <a href="{{ url('my-assets/gambar/galeri/gambar-3.jpg') }}" itemprop="contentUrl" data-size="480x360">
                                <img class="img-thumbnail img-fluid" src="{{ url('my-assets/gambar/galeri/gambar-3.jpg') }}" itemprop="thumbnail" alt="Image description" />
                            </a>
                        </figure>
                        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                            <a href="{{ url('my-assets/gambar/galeri/gambar-4.jpg') }}" itemprop="contentUrl" data-size="480x360">
                                <img class="img-thumbnail img-fluid" src="{{ url('my-assets/gambar/galeri/gambar-4.jpg') }}" itemprop="thumbnail" alt="Image description" />
                            </a>
                        </figure>
                        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                            <a href="{{ url('my-assets/gambar/galeri/gambar-5.jpg') }}" itemprop="contentUrl" data-size="480x360">
                                <img class="img-thumbnail img-fluid" src="{{ url('my-assets/gambar/galeri/gambar-5.jpg') }}" itemprop="thumbnail" alt="Image description" />
                            </a>
                        </figure>
                        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                            <a href="{{ url('my-assets/gambar/galeri/gambar-6.jpg') }}" itemprop="contentUrl" data-size="480x360">
                                <img class="img-thumbnail img-fluid" src="{{ url('my-assets/gambar/galeri/gambar-6.jpg') }}" itemprop="thumbnail" alt="Image description" />
                            </a>
                        </figure>
                        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                            <a href="{{ url('my-assets/gambar/galeri/gambar-7.jpg') }}" itemprop="contentUrl" data-size="480x360">
                                <img class="img-thumbnail img-fluid" src="{{ url('my-assets/gambar/galeri/gambar-7.jpg') }}" itemprop="thumbnail" alt="Image description" />
                            </a>
                        </figure>
                        <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                            <a href="{{ url('my-assets/gambar/galeri/gambar-8.jpg') }}" itemprop="contentUrl" data-size="480x360">
                                <img class="img-thumbnail img-fluid" src="{{ url('my-assets/gambar/galeri/gambar-8.jpg') }}" itemprop="thumbnail" alt="Image description" />
                            </a>
                        </figure>
                    </div>
                </div>
            <!--/ Image grid -->
          </div>
          <!--/ PhotoSwipe -->
        </section>
        <!--/ Image grid -->
        
    </div>
@endsection