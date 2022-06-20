<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Email</title>
</head>

<body>

    <div>
        <div style="width: 100%;
        max-width: 470px;
        text-align: left;
        border-radius: 8px;
        margin: 32px auto 0;
        padding: 0 20px;
        border: 1px solid #c9cccf;">
            <div>
                <h3 style="color: #202223;
                font-weight: 600;
                font-size: 16px;">Order Summary</h3>
            </div>

            <!-- Products Wrapper -->
            <div>
                @foreach ($products as $product)
                <div style="display: flex; justify-content: space-between;">
                    <div style="display: flex;">
                        <img src="{{ $product->image }}" alt="Product Image" style="height: 50px;
                        line-height: 0;
                        outline: none;
                        text-decoration: none;
                        vertical-align: top;
                        width: 50px;
                        margin-right: 16px;
                        border-radius: 4px;
                        border: 1px solid #c9cccf;">
                        <div>
                            <span style="display: block;">{{ $product->name }}</span>
                            <span>$ {{ $product->price }} x {{ $product->qty }}</span>
                        </div>
                    </div>
                    <div>
                        <span>$ {{ $product->price }}</span>
                    </div>
                </div>
                @endforeach


                <!-- Total -->
                <div style="display: flex;
                justify-content: space-between;
                margin-top: 1rem;
            ">
                    <span>Total</span>
                    <span>$ {{ number_format($products->sum('price'), 2) }}</span>
                </div>

            </div>
            <!-- Products Wrapper Ends -->

            <!-- Retailer Info -->
            <div style="margin-top: 2rem;">
                <div
                    style="font-weight: bold;                                                                                   border-bottom: 1px solid #ccc;padding-bottom: 0.5rem; display: inline-block;padding-right: 0.3rem;">
                    <span>Retailer
                        Details</span>
                </div>
                <div>
                    <p style="margin: 0.8rem 0 0;">
                        <span>
                            Business
                            Name:
                        </span> <span style="color: #4b4b4b;">
                            {{ $retailerDetails->business_name }}
                        </span>
                    </p>
                    <p style="margin: 0.8rem 0 0;">
                        <span>
                            Business
                            Type:
                        </span>
                        <span style="color: #4b4b4b;">
                            {{ $retailerDetails->business_type }} </span>
                    </p>

                    <p>
                        <span>
                            Email:
                        </span>
                        <span style="color: #4b4b4b;">
                            {{ $retailerDetails->email }} </span>
                    </p>
                    <p>
                        <span>
                            Phone Number:
                        </span>
                        <span style="color: #4b4b4b;">
                            {{ $retailerDetails->phone_number }} </span>

                    </p>

                    <p>
                        <span>
                            Country:
                        </span>
                        <span style="color: #4b4b4b;">
                            {{ $retailerDetails->country }} </span>
                    </p>


                    <p>
                        <span>
                            City:
                        </span>
                        <span style="color: #4b4b4b;">
                            {{ $retailerDetails->city }} </span>
                    </p>

                    <p>
                        <span>
                            State / Province:
                        </span>
                        <span style="color: #4b4b4b;">
                            {{ $retailerDetails->state_province }} </span>
                    </p>
                    <p>
                        <span>
                            Address:
                        </span>
                        <span style="color: #4b4b4b;">
                            {{ $retailerDetails->address_line_1 }} </span>
                    </p>

                </div>
            </div>
            <!-- Retailer Info Ends -->

            <div style="display: flex; justify-content: space-between; margin: 1rem 0;">
                <a href="https://www.420finder.net" style="margin: auto">
                    <img src="https://www.420finder.net/assets/img/logo.png" alt="Site Logo" style="width: 100px;
                    height: 57px;">
                </a>
            </div>

        </div>
    </div>

</body>

</html>
