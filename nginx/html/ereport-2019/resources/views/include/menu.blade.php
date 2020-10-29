<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow" role="navigation" data-menu="menu-wrapper">
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item @if(isset($varGlobal['beranda'])) {{ $varGlobal['beranda'] }} @endif">
                <a class="nav-link" href="{{ url('/beranda') }}"><i class="la la-home"></i><span>Beranda</span></a>
            </li>
            <li class="dropdown nav-item  @if(isset($varGlobal['prognosis'])) {{ $varGlobal['prognosis'] }} @endif" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-file-text"></i><span>Prognosis</span></a>
                <ul class="dropdown-menu">
                    <li data-menu="">
                        <a class="dropdown-item" href="{{ url('prognosis/kode-kegiatan') }}" data-toggle="dropdown"><i class="la la-check-square"></i>Kode Kegiatan Prognosis</a>
                    </li>
                    <li data-menu="">
                        <a class="dropdown-item" href="{{ url('prognosis/kode-rincian-objek') }}" data-toggle="dropdown"><i class="la la-flag-o"></i>Rincian Objek Prognosis</a>
                    </li>
                    {{-- <li data-menu="">
                        <a class="dropdown-item" href="{{ url('prognosis/konvert-akun-prognosis') }}" data-toggle="dropdown"><i class="la la-archive"></i>Konvert Kode Akun Prognosis</a>
                    </li> --}}
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i class="la la-file"></i>Laporan</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{ url('prognosis/laporan/lra-prognosis-sap') }}" data-toggle="dropdown">LRA Prognosis (SAP)</a></li>
                            <li data-menu=""><a class="dropdown-item" href="{{ url('prognosis/laporan/lra-prognosis-permen') }}" data-toggle="dropdown">LRA Prognosis (PERMEN)</a></li>
                            <li data-menu=""><a class="dropdown-item" href="{{ url('prognosis/laporan/lra-rincian-prognosis') }}" data-toggle="dropdown">LRA Rincian Prognosis</a></li>
                            <li data-menu=""><a class="dropdown-item" href="{{ url('prognosis/laporan/lra-penjabaran-prognosis') }}" data-toggle="dropdown">LRA Penjabaran Prognosis</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown nav-item  @if(isset($varGlobal['entry-data'])) {{ $varGlobal['entry-data'] }} @endif" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-th-list"></i><span>Entry Data</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i class="la la-ship"></i>SKPD</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i class="la la-calculator"></i>Akuntansi</a>
                                 <ul class="dropdown-menu">
                                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                                        <li data-menu=""><a class="dropdown-item" href="{{ url('entry-data/skpd/akuntansi/posting') }}" data-toggle="dropdown">Posting</a></li>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @if(Auth::user()->jabatan == 19)
            <li class="dropdown nav-item  @if(isset($varGlobal['konsolidasi'])) {{ $varGlobal['konsolidasi'] }} @endif" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-leanpub"></i><span>Konsolidasi</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i class="la la-file"></i>Laporan Prognosis</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{ url('konsolidasi/prognosis/lra-prognosis-sap') }}" data-toggle="dropdown">LRA Prognosis (SAP)</a></li>
                            <li data-menu=""><a class="dropdown-item" href="{{ url('konsolidasi/prognosis/lra-prognosis-permen') }}" data-toggle="dropdown">LRA Prognosis (PERMEN)</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown nav-item  @if(isset($varGlobal['pengaturan'])) {{ $varGlobal['pengaturan'] }} @endif" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-gear"></i><span>Pengaturan</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i class="la la-file"></i>Laporan</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{ url('pengaturan/laporan/tanda-tangan') }}" data-toggle="dropdown">Tanda Tangan Pejabat</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endif
            {{-- <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-gear"></i><span>Pengaturan</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i class="la la-edit"></i>Editors</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="editor-quill.html" data-toggle="dropdown">Quill</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="editor-ckeditor.html" data-toggle="dropdown">CKEditor</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="editor-summernote.html" data-toggle="dropdown">Summernote</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="editor-tinymce.html" data-toggle="dropdown">TinyMCE</a>
                            </li>
                            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown">Code Editor</a>
                                <ul class="dropdown-menu">
                                    <li data-menu=""><a class="dropdown-item" href="code-editor-codemirror.html" data-toggle="dropdown">CodeMirror</a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item" href="code-editor-ace.html" data-toggle="dropdown">Ace</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i class="la la-calendar"></i>Pickers</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="pickers-date-&amp;-time-picker.html" data-toggle="dropdown">Date &amp; Time Picker</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="pickers-color-picker.html" data-toggle="dropdown">Color Picker</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i class="la la-code-fork"></i>jQuery UI</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="jquery-ui-interactions.html" data-toggle="dropdown">Interactions</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="jquery-ui-navigations.html" data-toggle="dropdown">Navigations</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="jquery-ui-date-pickers.html" data-toggle="dropdown">Date Pickers</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="jquery-ui-autocomplete.html" data-toggle="dropdown">Autocomplete</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="jquery-ui-buttons-select.html" data-toggle="dropdown">Buttons &amp; Select</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="jquery-ui-slider-spinner.html" data-toggle="dropdown">Slider &amp; Spinner</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="jquery-ui-dialog-tooltip.html" data-toggle="dropdown">Dialog &amp; Tooltip</a>
                            </li>
                        </ul>
                    </li>
                    <li data-menu="">
                        <a class="dropdown-item" href="add-on-block-ui.html" data-toggle="dropdown"><i class="la la-terminal"></i>Block UI</a>
                    </li>
                    <li data-menu="">
                        <a class="dropdown-item" href="add-on-image-cropper.html" data-toggle="dropdown"><i class="la la-crop"></i>Image Cropper</a>
                    </li>
                    <li data-menu="">
                        <a class="dropdown-item" href="add-on-drag-drop.html" data-toggle="dropdown"><i class="la la-mouse-pointer"></i>Drag &amp; Drop</a>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i class="la la-cloud-upload"></i>File Uploader</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="file-uploader-dropzone.html" data-toggle="dropdown">Dropzone</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i class="la la-calendar"></i>Event Calendars</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown">Full Calendar</a>
                                <ul class="dropdown-menu">
                                    <li data-menu=""><a class="dropdown-item" href="full-calender-basic.html" data-toggle="dropdown">Basic</a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item" href="full-calender-events.html" data-toggle="dropdown">Events</a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item" href="full-calender-advance.html" data-toggle="dropdown">Advance</a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item" href="full-calender-extra.html" data-toggle="dropdown">Extra</a>
                                    </li>
                                </ul>
                            </li>
                            <li data-menu="">
                                <a class="dropdown-item" href="calendars-clndr.html" data-toggle="dropdown"><i class="la la-calendar"></i>CLNDR</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i class="la la-flag-o"></i>Internationalization</a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="i18n-resources.html" data-toggle="dropdown">Resources</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="i18n-xhr-backend.html" data-toggle="dropdown">XHR Backend</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="i18n-query-string.html?lng=en" data-toggle="dropdown">Query String</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="i18n-on-init.html" data-toggle="dropdown">On Init</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="i18n-after-init.html" data-toggle="dropdown">After Init</a>
                            </li>
                            <li data-menu=""><a class="dropdown-item" href="i18n-fallback.html" data-toggle="dropdown">Fallback</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</div>
