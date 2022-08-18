  <!-- JS Links Start -->
  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="{{URL::to('/js/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::to('js/popper.min.js')}}"></script>
  <script src="{{URL::to('js/bootstrap.bundle.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>
  <script src="{{URL::to('/js/custom.js')}}"></script>
  @stack('js')
  <script>
    $('.education-slider').slick({
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [{
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: false,
            dots: true
          }
        }, {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        }, {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }, {
          breakpoint: 374,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
  </script>
  <script>
    $(document).ready(function(){
      //var xValues = [$('#students').val()];
      var xValues = ['Aban Fajr', 'Athar Kairo', 'Safi Talal', 'Zayd Omar', 'Malik Kairo'];
      var yValues = [55, 49, 44, 24, 30];
      var barColors = ["red", "green", "blue", "orange", "brown"];
      setTimeout(() => {
        new Chart("myChart", {
        type: "bar",
        data: {
          labels: xValues,
          datasets: [{
            backgroundColor: barColors,
            data: yValues
          }]
        },
        options: {
          legend: {
            display: false
          },
          title: {
            display: true,
            text: ""
          }
        }
      });
      }, 1000);
    });
  </script>
  <!-- JS Links End -->
  </body>
</html>