@extends('layouts.app')

    @section('title', '420 Finder')
    
    @section('content')

    <section class="mt-5 pt-5">

        <div class="container mt-4">

            <div class="row pt-5 customerLeftSidebar">

                <div class="col-md-3">
                    @include('partials/sidebar')
                </div>

                <div class="col-md-9">

                    <div class="card p-3">

                        <div class="row">
                            <div class="col-md-6">
                                <h6>Order #{{ $tracking_number }} details</h6>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('orderhistory') }}" class="btn border bg-white shadow-sm btn-sm">Go Back</a>
                            </div>
                        </div>

                        

                        <div class="row mt-3">

                            <div class="col-md-12">

                                <div class="table-responsive">
                                    
                                    <table class="table table-hover">
                                        
                                        <thead>
                                            <th>#</th>
                                            <th>Retailer</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                        </thead>

                                        <tbody>
                                            
                                            @if($orders->count() > 0)
                                                <?php $total = 0; ?>
                                                @foreach($orders as $index => $order)
                                                    <?php $total = $total + $order->price; ?>
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            <?php
                                                                $retailer = App\Models\Business::where('id', $order->retailer_id)->select('business_name', 'business_type')->first();
                                                                echo $retailer->business_name . '<br><span class="text-black-50" style="font-size: 12px;">( ' . $retailer->business_type . ' )</span>';
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if ($retailer->business_type == 'Dispensary') {
                                                                    $product = App\Models\DispenseryProduct::where('id', $order->product_id)->select('name', 'image')->first();
                                                                    echo "<img src=" . $product->image . " style='width: 50px;height:50px;'> " . substr($product->name, 0,30)."...";
                                                                } else {
                                                                    $product = App\Models\DeliveryProducts::where('id', $order->product_id)->select('name', 'image')->first();
                                                                    echo "<img src=" . $product->image . " style='width: 50px;height:50px;'> " . substr($product->name, 0,30)."...";
                                                                }
                                                                
                                                            ?>
                                                        </td>
                                                        <td>${{ $order->price }}</td>
                                                        <td>{{ $order->qty }}</td>
                                                    </tr>
                                                    
                                                @endforeach
                                                <tr class="bg-light">
                                                    <td colspan="2"><strong>Total Paid:</strong></td>
                                                    <td colspan="3" class="text-end"><strong>$<?php echo $total; ?></strong></td>
                                                </tr>
                                            @else
                                                <tr class="text-center">
                                                    <td colspan="5">No Orders yet.</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection