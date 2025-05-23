/*---LEFT BAR ACCORDION----*/
$(function () {
  $('#nav-accordion').dcAccordion({
    eventType: 'click',
    autoClose: true,
    saveState: true,
    disableLink: true,
    speed: 'slow',
    showCount: false,
    autoExpand: true,
    //        cookie: 'dcjq-accordion-1',
    classExpand: 'dcjq-current-parent'
  });
});

var Script = function () {


  //    sidebar dropdown menu auto scrolling

  jQuery('#sidebar .sub-menu > a').click(function () {
    var o = ($(this).offset());
    diff = 250 - o.top;
    if (diff > 0)
      $("#sidebar").scrollTo("-=" + Math.abs(diff), 500);
    else
      $("#sidebar").scrollTo("+=" + Math.abs(diff), 500);
  });



  //    sidebar toggle

  $(function () {
    function responsiveView() {
      var wSize = $(window).width();
      if (wSize <= 768) {
        $('#container').addClass('sidebar-close');
        $('#sidebar > ul').hide();
      }

      if (wSize > 768) {
        $('#container').removeClass('sidebar-close');
        $('#sidebar > ul').show();
      }
    }
    $(window).on('load', responsiveView);
    $(window).on('resize', responsiveView);
  });

  $('.fa-bars').click(function () {
    if ($('#sidebar > ul').is(":visible") === true) {
      $('#main-content').css({
        'margin-left': '0px'
      });
      $('#sidebar').css({
        'margin-left': '-210px'
      });
      $('#sidebar > ul').hide();
      $("#container").addClass("sidebar-closed");
    } else {
      $('#main-content').css({
        'margin-left': '210px'
      });
      $('#sidebar > ul').show();
      $('#sidebar').css({
        'margin-left': '0'
      });
      $("#container").removeClass("sidebar-closed");
    }
  });

  // custom scrollbar
  $("#sidebar").niceScroll({
    styler: "fb",
    cursorcolor: "#4ECDC4",
    cursorwidth: '3',
    cursorborderradius: '10px',
    background: '#404040',
    spacebarenabled: false,
    cursorborder: ''
  });

  //  $("html").niceScroll({styler:"fb",cursorcolor:"#4ECDC4", cursorwidth: '6', cursorborderradius: '10px', background: '#404040', spacebarenabled:false,  cursorborder: '', zindex: '1000'});

  // widget tools

  jQuery('.panel .tools .fa-chevron-down').click(function () {
    var el = jQuery(this).parents(".panel").children(".panel-body");
    if (jQuery(this).hasClass("fa-chevron-down")) {
      jQuery(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
      el.slideUp(200);
    } else {
      jQuery(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
      el.slideDown(200);
    }
  });

  jQuery('.panel .tools .fa-times').click(function () {
    jQuery(this).parents(".panel").parent().remove();
  });


  //    tool tips

  $('.tooltips').tooltip();

  //    popovers

  $('.popovers').popover();



  // custom bar chart

  if ($(".custom-bar-chart")) {
    $(".bar").each(function () {
      var i = $(this).find(".value").html();
      $(this).find(".value").html("");
      $(this).find(".value").animate({
        height: i
      }, 2000)
    })
  }

}();

jQuery(document).ready(function ($) {

  // Go to top
  $('.go-top').on('click', function (e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: 0 }, 500);
  });
});


var myLoadingPage
function loadingPage() {
  myLoadingPage = setTimeout(showPage, 100);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("content").style.display = "block";
}

var _validFileExtensions = [".jpg"];
function ValidateSingleInputJPG(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensions.length; j++) {
        var sCurExtension = _validFileExtensions[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;

        }
      }

      if (!blnValid) {
        Swal.fire({
          icon: 'error',
          title: 'File format harus JPG !',
          showConfirmButton: true,
          timer: 5000
        });
        oInput.value = "";
        return false;
      }
    }
  }
  return true;
};

var _validFileExtensionpdf = ["pdf", "PDF", "Pdf"];
function ValidateSingleInputpdf(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensionpdf.length; j++) {
        var sCurExtension = _validFileExtensionpdf[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;

        }
      }

      if (!blnValid) {
        Swal.fire({
          icon: 'error',
          title: 'File format harus pdf !',
          showConfirmButton: true,
          timer: 5000
        });
        oInput.value = "";
        return false;
      }
    }
  }
  return true;
};

var _validFileExtensionImage = ["jpg", "jpeg", "png"];
function ValidateImage(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensionImage.length; j++) {
        var sCurExtension = _validFileExtensionImage[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;

        }
      }

      if (!blnValid) {
        console.log('error eks');
        Swal.fire({
          icon: 'error',
          title: 'File format harus .jpg, .jpeg, .png !',
          showConfirmButton: true,
          timer: 5000
        });
        oInput.value = "";
        return false;
      }
    }
  }
  return true;
};


function ValidateSize(file) {
  var FileSize = file.files[0].size;
  if (FileSize > 1000000) {
    console.log('error eks');
    Swal.fire({
      icon: 'error',
      title: 'Ukuran file maks 1MB',
      showConfirmButton: true,
      timer: 5000
    });
    file.value = "";
    return false;
  } else {

  }
}

function ValidateSizePengajuan(file) {
  var FileSize = file.files[0].size;
  if (FileSize > 2097152) {
    Swal.fire({
      icon: 'error',
      title: 'Ukuran file maks 2MB',
      showConfirmButton: true,
      timer: 5000
    });
    file.value = "";
    return false;
  } else {

  }
}

var _validFileExtensionsExcel = [".xls", ".xlsx"];

function ValidateSingleInputExcel(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensionsExcel.length; j++) {
        var sCurExtension = _validFileExtensionsExcel[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;

        }
      }

      if (!blnValid) {
        Swal.fire({
          icon: 'error',
          title: 'File format harus Excel !',
          showConfirmButton: true,
          timer: 5000
        });
        oInput.value = "";
        return false;
        $('.cekButton').attr('disabled', true);
      } else {
        $('.cekButton').removeAttr('disabled');
      }
    }
  }
  return true;
};
$(".custom-file-input").on("change", function () {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

//data table
if (document.getElementById("member_table")) {
  $(document).ready(function () {
    $('#member_table').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': false,
      'info': true,
      'autoWidth': true
    })
  });
};


//manajemen akun
$(document).ready(function () {
  $('#addUser').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-add-user").style.display = "block";
    document.getElementById("add-user").style.display = "none";
    $.ajax({
      url: 'dashboard/modul/data-admin/modal/tambah_admin',
      success: function (data) {
        document.getElementById("load-add-user").style.display = "none";
        document.getElementById("add-user").style.display = "block";
        $('.add-user').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});
$(document).ready(function () {
  $('#editUser').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-edit-user").style.display = "block";
    document.getElementById("edit-user").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-admin/modal/ubah_admin',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-edit-user").style.display = "none";
        document.getElementById("edit-user").style.display = "block";
        $('.edit-user').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});
$(document).ready(function () {
  $('#delUser').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-del-user").style.display = "block";
    document.getElementById("del-user").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-admin/modal/hapus_admin',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-del-user").style.display = "none";
        document.getElementById("del-user").style.display = "block";
        $('.del-user').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});

//manajemen ptk
$(document).ready(function () {
  $('#addJabatan').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-add-jabatan").style.display = "block";
    document.getElementById("add-jabatan").style.display = "none";
    $.ajax({
      url: 'dashboard/modul/data-ptk/modal/tambah_jabatan_ptk',
      success: function (data) {
        document.getElementById("load-add-jabatan").style.display = "none";
        document.getElementById("add-jabatan").style.display = "block";
        $('.add-jabatan').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});
$(document).ready(function () {
  $('#editJabatan').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-edit-jabatan").style.display = "block";
    document.getElementById("edit-jabatan").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-ptk/modal/ubah_jabatan_ptk',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-edit-jabatan").style.display = "none";
        document.getElementById("edit-jabatan").style.display = "block";
        $('.edit-jabatan').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});
$(document).ready(function () {
  $('#delJabatan').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-del-jabatan").style.display = "block";
    document.getElementById("del-jabatan").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-ptk/modal/hapus_jabatan_ptk',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-del-jabatan").style.display = "none";
        document.getElementById("del-jabatan").style.display = "block";
        $('.del-jabatan').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});

//manajemen profil
$(document).ready(function () {
  $('#teks_sejarah').summernote({
    placeholder: 'sejarah singkat sekolah',
    toolbar: [
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough', 'superscript', 'subscript']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']]
    ]
  });
});
$(document).ready(function () {
  $('#teks_visimisi').summernote({
    placeholder: 'visi dan misi sekolah',
    toolbar: [
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough', 'superscript', 'subscript']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']]
    ]
  });
});

//manajemen ptk
$(document).ready(function () {
  $('#addPTK').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
    document.getElementById("load-add-ptk").style.display = "block";
    document.getElementById("add-ptk").style.display = "none";
    $.ajax({
      url: 'dashboard/modul/data-ptk/modal/tambah_ptk',
      success: function (data) {
        document.getElementById("load-add-ptk").style.display = "none";
        document.getElementById("add-ptk").style.display = "block";
        $('.add-ptk').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
  });
});
$(document).ready(function () {
  $('#detailPTK').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
    document.getElementById("load-detail-ptk").style.display = "block";
    document.getElementById("detail-ptk").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-ptk/modal/detail_ptk',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-detail-ptk").style.display = "none";
        document.getElementById("detail-ptk").style.display = "block";
        $('.detail-ptk').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
  });
});
$(document).ready(function () {
  $('#editPTK').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
    document.getElementById("load-edit-ptk").style.display = "block";
    document.getElementById("edit-ptk").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-ptk/modal/ubah_ptk',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-edit-ptk").style.display = "none";
        document.getElementById("edit-ptk").style.display = "block";
        $('.edit-ptk').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
  });
});
$(document).ready(function () {
  $('#delPTK').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
    document.getElementById("load-del-ptk").style.display = "block";
    document.getElementById("del-ptk").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-ptk/modal/hapus_ptk',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-del-ptk").style.display = "none";
        document.getElementById("del-ptk").style.display = "block";
        $('.del-ptk').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
  });
});

//manajemen galeri
$(document).ready(function () {
  $('#addImage').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-image").style.display = "block";
    document.getElementById("add-image").style.display = "none";
    $.ajax({
      url: 'dashboard/modul/data-galeri/modal/tambah_galeri',
      success: function (data) {
        document.getElementById("load-add-image").style.display = "none";
        document.getElementById("add-image").style.display = "block";
        $('.add-image').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#editImage').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-edit-image").style.display = "block";
    document.getElementById("edit-image").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-galeri/modal/ubah_galeri',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-edit-image").style.display = "none";
        document.getElementById("edit-image").style.display = "block";
        $('.edit-image').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#delImage').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-image").style.display = "block";
    document.getElementById("del-image").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-galeri/modal/hapus_galeri',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-del-image").style.display = "none";
        document.getElementById("del-image").style.display = "block";
        $('.del-image').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

//manajemen pengumuman
$(document).ready(function () {
  $('#addPengumuman').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-pengumuman").style.display = "block";
    document.getElementById("add-pengumuman").style.display = "none";
    $.ajax({
      url: 'dashboard/modul/data-pengumuman/modal/tambah_pengumuman',
      success: function (data) {
        document.getElementById("load-add-pengumuman").style.display = "none";
        document.getElementById("add-pengumuman").style.display = "block";
        $('.add-pengumuman').html(data);
        $('#isi_pengumuman').summernote({
          placeholder: 'Deskripsi Pengumuman',
          height: 100,
          toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
          ]
        });
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#editPengumuman').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-edit-pengumuman").style.display = "block";
    document.getElementById("edit-pengumuman").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-pengumuman/modal/ubah_pengumuman',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-edit-pengumuman").style.display = "none";
        document.getElementById("edit-pengumuman").style.display = "block";
        $('.edit-pengumuman').html(data);
        $('#ubah_isi_pengumuman').summernote({
          placeholder: 'Deskripsi Pengumuman',
          height: 100,
          toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
          ]
        });
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#delPengumuman').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-pengumuman").style.display = "block";
    document.getElementById("del-pengumuman").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-pengumuman/modal/hapus_pengumuman',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-del-pengumuman").style.display = "none";
        document.getElementById("del-pengumuman").style.display = "block";
        $('.del-pengumuman').html(data);
        $('#hapus_isi_pengumuman').summernote("disable");
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

//manajemen berita
$(document).ready(function () {
  $('#addTag').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-add-tag").style.display = "block";
    document.getElementById("add-tag").style.display = "none";
    $.ajax({
      url: 'dashboard/modul/data-berita/modal/tambah_tag_berita',
      success: function (data) {
        document.getElementById("load-add-tag").style.display = "none";
        document.getElementById("add-tag").style.display = "block";
        $('.add-tag').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});
$(document).ready(function () {
  $('#editTag').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-edit-tag").style.display = "block";
    document.getElementById("edit-tag").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-berita/modal/ubah_tag_berita',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-edit-tag").style.display = "none";
        document.getElementById("edit-tag").style.display = "block";
        $('.edit-tag').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});
$(document).ready(function () {
  $('#delTag').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-del-tag").style.display = "block";
    document.getElementById("del-tag").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-berita/modal/hapus_tag_berita',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-del-tag").style.display = "none";
        document.getElementById("del-tag").style.display = "block";
        $('.del-tag').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});
$(document).ready(function () {
  $('#addBerita').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-berita").style.display = "block";
    document.getElementById("add-berita").style.display = "none";
    $.ajax({
      url: 'dashboard/modul/data-berita/modal/tambah_berita',
      success: function (data) {
        document.getElementById("load-add-berita").style.display = "none";
        document.getElementById("add-berita").style.display = "block";
        $('.add-berita').html(data);
        $('#isi_berita').summernote({
          placeholder: 'Deskripsi berita',
          height: 100,
          toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
          ]
        });
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#editBerita').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-edit-berita").style.display = "block";
    document.getElementById("edit-berita").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-berita/modal/ubah_berita',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-edit-berita").style.display = "none";
        document.getElementById("edit-berita").style.display = "block";
        $('.edit-berita').html(data);
        $('#ubah_isi_berita').summernote({
          placeholder: 'Deskripsi berita',
          height: 100,
          toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
          ]
        });
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#delBerita').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-berita").style.display = "block";
    document.getElementById("del-berita").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/modul/data-berita/modal/hapus_berita',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-del-berita").style.display = "none";
        document.getElementById("del-berita").style.display = "block";
        $('.del-berita').html(data);
        $('#hapus_isi_berita').summernote("disable");
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
