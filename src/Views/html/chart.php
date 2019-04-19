<?php
require_once 'layouts/header.php';
?>

<div style="margin-top: 20px">

    <h3>Chart</h3>
    <div>
        <div class="ct-chart ct-perfect-fourth"></div>
    </div>

</div>

<script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

<script>

  var options = {

  };

  new Chartist.Bar('.ct-chart', {
    labels: <?php echo json_encode($data['countries']); ?> ,
    series: [
        <?php echo json_encode($data['levels']) ?>
    ]
  }, {
    seriesBarDistance: 10,
    reverseData: true,
    horizontalBars: true,
    axisY: {
      offset: 250
    },
    width: '100%',
    height: '200%'
  });

</script>

<?php
require_once 'layouts/footer.php';
?>
