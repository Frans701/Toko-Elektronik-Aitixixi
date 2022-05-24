@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">  <!-- table produk -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"><strong>Produk</strong></h4>
          {{-- <div class="card-tools">
            <a href="/produk" class="btn btn-sm btn-danger">
              More
            </a>
          </div> --}}
        </div>
        <div class="card-body">

          {{-- isi --}}
          <div class="container">
            <div class="grid-margin stretch-card pt-5">
            <div class="card">
            <div class="card-body">
            <div id="container" style="width: 95%;">
            <canvas id="canvas"></canvas>
            </div>
            <?php
                $bulan = ["$january", "$february","$march","$april","$may","$june","$july","$august","$september","$october","$november","$december"];
                //$bulans = ["0", "100","1","100","100","100","9","100","100","8","100","100"];
                
            ?>

            <?php 
                //misal ada 3 dealer
                $transaksi = 1;
                $k=0;
                for($d=1; $d<=$transaksi;$d++){
                //kemudian misal data dari bulan 1 hingga bulan 12
                    for($b=1;$b<=12;$b++){
                        $data[$d][$b] = $bulan[$k];
                        $k++;
                        
                    }
                }
                // echo $data[1][5];
               
               
                function random_color(){  
                    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                }
            ?>
        
            <script>
                var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                var color = Chart.helpers.color;
                var barChartData = {
                    labels: MONTHS,
                    datasets: [
                        <?php 
                                for($d=1;$d<=$transaksi;$d++){
                                    $color = random_color();
                                    ?>
                                    {
                                        label: '<?php echo "Transaksi success ";?>',
                                        backgroundColor: color('<?php echo $color;?>').alpha(0.5).rgbString(),
                                        borderColor: '<?php echo $color;?>',
                                        borderWidth: 1,
                                        data: [
                                            <?php 
                                                for($b=1;$b<=12;$b++){
                                                    echo $data[$d][$b].",";
                                                }
                                            ?>     
                                        ]
                                    },
                                    <?php 
                                }
                        ?>
                    ]    
                };
                
                window.onload = function() {
                    var ctx = document.getElementById('canvas').getContext('2d');
                    window.myBar = new Chart(ctx, {
                        type: 'bar',
                        data: barChartData,
                        options: {
                            responsive: true,
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Grafik Transaksi bulanan'
                            }
                        }
                });
                
                };        
            </script>
            </div>
            </div>
            </div>
    
            <div class="grid-margin stretch-card pt-5">
                <div class="card">
                    <div class="card-body">
                    <!-- OVERVIEW -->
                        <div class="panel panel-headline">
                            <div class="panel-heading ">
                                <p class="panel-subtitle" style="font-weight: bold">Periode: {{ date('d-m-Y H:m:s', strtotime($now)) }}</p>
                            </div>
                            
                            <div class="panel-body mt-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="metric">
                                            <span class="icon">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            </span>
                                            <p>
                                                <span class="number">{{ $monthlySales }}</span>
                                                <span class="title">Penjualan Bulanan</span>
                                            </p>
                                        
                                            <div class="weekly-summary">
                                                <span class="number">Rp{{ number_format($incomeMonthly) }}</span>
                                                <span class="info-label">Pendapatan Bulanan</span>
                                            </div>
                                        
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="metric">
                                            <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                                            <p>
                                                <span class="number">{{ $annualSales }}</span>
                                                <span class="title">Penjualan Tahunan</span>
                                                
                                            </p>

                                            <div class="weekly-summary ">
                                                <span class="number">Rp{{ number_format($incomeAnnual) }}</span>
                                                <span class="info-label">Pendapatan Tahunan</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="metric">
                                            <span class="icon"><i class="fa fa-cart-plus" aria-hidden="true"></i>
                                            </span>
                                            <p>
                                                <span class="number">{{ $allSales }}</span>
                                                <span class="title">Total Penjualan</span>
                                            </p>
                                            <div class="weekly-summary">
                                                <span class="number">Rp{{ number_format($incomeTotal) }}</span>
                                                <span class="info-label">Total Pendapatan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- END OVERVIEW -->
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ( $products as $product )
                <div class="col-md-4 mb-3">
                    <div class="card">
                      @if($product->categories->isNotEmpty())
                        <div class="position-absolute bg-dark px-3 py-2 text-white"> <a class="text-white text-decoration-none">{{ $product->categories->pluck('category_name')->implode(',') }}</a></div>
                      @endif
                      @if($product->images->isNotEmpty())
                      <img src="{{ asset('storage/' . $product->images[0]->image_name) }}"
                          class="img-fluid mt-3 img-box" alt=" {{ $product->product_name }}">
                      @else
                      <img src="https://source.unsplash.com/500x400?{{ $product->product_name }}"
                      class="img-fluid mt-3 img-box" alt=" {{ $product->product_name }}">
                      @endif
                      <div class="card-body">
                          <div>
                            <h5>{{ $product->product_name }}</h5>
                          </div>
                          <div>
                                <small>
                                    By <a href="/authors/{{ $product->product_name }}"
                                        class="text-decoration-none">{{ auth()->user()->admin_name }}</a>
                                    {{ $product->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <p class="card-text">{{ $product->excerpt }}</p>
                            <a href="/admin/products/{{ $product->id }}" class="btn btn-primary">Detail</a>
                          </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- @foreach ( $products as $category )
          <ul>
              <li>
                  <h2>{{ $category->product_name }}</h2>
              </li>
          </ul>
        @endforeach --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection