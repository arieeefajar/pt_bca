function ajax(method, url, callback) {
  $.ajax({
    type: method,
    url: url,
    dataType: 'json',
    beforeSend: function () {
      Swal.fire({
        title: 'Loading...',
        allowOutsideClick: false,
        showConfirmButton: false,
      })
    },
    success: function (response) {
      Swal.close()
      callback(response)
    },
    error: function (request) {
      Swal.fire({
        icon: 'error',
        title: 'Error Response Server',
        showConfirmButton: true,
        timer: 15000,
      })
    },
  })
}
