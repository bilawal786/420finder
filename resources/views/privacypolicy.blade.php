@extends('layouts.app')

    @section('title', '420 Finder')
    
    @section('content')

    <section class="mt-5 pt-5">

        <div class="container pt-4 mt-4">

            <div class="row">

                <div class="col-md-12">
                    <h4>Privacy Policy</h4>
                </div>

            </div>

            <div class="row">
            
                <div class="col-md-12">
                    <?php echo $policy->privacypolicy; ?>
                </div>

            </div>

        </div>

    </section>

@endsection