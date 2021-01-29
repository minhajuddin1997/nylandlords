<div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
        Market Place
      </h1>
    </div>
    <hr style="border-top: 1px solid #504444;">

    <div class="col-md-12">  

    <div class="row">
        <!--<div class="col-md-4">-->
        <!--    <div class="card p-3" style="padding:1rem;">-->
        <!--        <div class="d-flex flex-row mb-3">-->
        <!--            <div class="row">-->
        <!--                 <div class="col-1 col-md-2 col-xs-4">-->
        <!--                     <img src="https://i.imgur.com/ccMhxvC.png" width="70">-->
        <!--                 </div>-->
        <!--                 <div class="col-1 col-lg-4 col-xs-5">-->
        <!--                    <div class="d-flex flex-column ml-2"><span>Stripe</span><span class="text-black-50">Payment Services</span><span class="ratings">-->
        <!--                         <br>-->
        <!--                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span></div>-->
        <!--                 </div>-->
        <!--            </div>-->
        <!--           </div>-->
        <!--        <h6>Get more context on your users with stripe data inside our platform.</h6>-->
        <!--        <div class="d-flex justify-content-between install mt-3"><span>Installed 172 times</span><span class="text-primary">View&nbsp;<i class="fa fa-angle-right"></i></span></div>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="flex-container">
          <div style="flex-grow: 2">
              <iframe width="560" height="315" src="<?php echo $records[0]->video; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
          <div style="flex-grow: 55">
              
              <H4><?php echo $records[0]->name; ?></H4>
              <p style="justify-content: stretch;">
                  <?php echo $records[0]->description; ?>
              </p>
              <button class='btn btn-info'><a href="<?php echo base_url('MarketPlace/add_data'); ?>/<?php echo $records[0]->id; ?>" >Read Further</a></button>
          </div>
        </div>
        <!-- PRICING PLANS -->
  <section class="pricing-plans">
    <!-- Pricing Tables -->
       <div class="pricing-tables">
    <?php foreach($packages as $row): ?>
       
      <!-- Plan Features -->
      <!--<div class="pricing-plan <?php //echo ($row->packages_title == 'Premium') ?  'featured-plan' : ''; ?>">-->
      <!--  <h2 class="plan-title"><?php //echo $row->packages_title; ?></h2>-->
      <!--  <div class="plan-cost">-->
      <!--    <p class="plan-price">$<?php //echo $row->package_price; ?></p>-->
      <!--    <span>/</span> -->
      <!--    <p class="plan-type"><?php// echo $row->package_charge_type; ?></p>-->
      <!--  </div>-->
      <!--  <ul class="plan-features">-->
      <!--    <li>Unlimited Templates</li>-->
      <!--    <li>Responsive / Mobile Friendly</li>-->
      <!--    <li><span>Unlimited Training</span></li>-->
      <!--    <li><span>Custom Branding</span></li>-->
      <!--    <li><span>Resource Library</span></li>-->
      <!--    <li><span>Dedicated Support</span></li>-->
      <!--  </ul>-->
      <!--  <a class="btn btn-plan" href="<?php //echo base_url('MarketPlace/pays/'); ?><?php echo $records[0]->id . '/'; ?><?php echo $row->id; ?>">Select Plan</a>-->
      <!--</div>-->
      <!-- "Basic" Plan -->
    
    <?php endforeach; ?>
    </div>
  </section>
 
  <!-- PRICING PLANS -->
  <!--<section class="pricing-plans">-->
    <!-- Pricing Tables -->
  <!--  <div class="pricing-tables">-->
      <!-- Plan Features -->
  <!--    <div class="pricing-plan">-->
  <!--      <h2 class="plan-title">Basic</h2>-->
  <!--      <div class="plan-cost">-->
  <!--        <p class="plan-price">$29</p>-->
  <!--        <span>/</span> -->
  <!--        <p class="plan-type">Monthly</p>-->
  <!--      </div>-->
  <!--      <ul class="plan-features">-->
  <!--        <li>Unlimited Templates</li>-->
  <!--        <li>Responsive / Mobile Friendly</li>-->
  <!--        <li><span>Unlimited Training</span></li>-->
  <!--        <li><span>Custom Branding</span></li>-->
  <!--        <li><span>Resource Library</span></li>-->
  <!--        <li><span>Dedicated Support</span></li>-->
  <!--      </ul>-->
  <!--      <a class="btn btn-info" href="">Select Plan</a>-->
  <!--    </div>-->
      <!-- "Basic" Plan -->
  <!--    <div class="pricing-plan">-->
  <!--      <h2 class="plan-title">Super</h2>-->
  <!--      <div class="plan-cost">-->
  <!--        <p class="plan-price">$39</p>-->
  <!--        <span>|</span> -->
  <!--        <p class="plan-type">Monthly</p>-->
  <!--      </div>-->
  <!--      <ul class="plan-features">-->
  <!--        <li>Unlimited Templates</li>-->
  <!--        <li>Responsive / Mobile Friendly</li>-->
  <!--        <li>Unlimited Training</li>-->
  <!--        <li><span>Custom Branding</span></li>-->
  <!--        <li><span>Resource Library</span></li>-->
  <!--        <li><span>Dedicated Support</span></li>-->
  <!--      </ul>-->
  <!--      <a class="btn btn-info" href="">Select Plan</a>-->
  <!--    </div>-->
      <!-- "Premium" Plan -->
  <!--    <div class="pricing-plan featured-plan">-->
  <!--      <div class="featured-ribbon">Best Value</div>-->
  <!--      <h2 class="plan-title">Premium</h2>-->
  <!--      <div class="plan-cost">-->
  <!--        <p class="plan-price">$59</p>-->
  <!--        <span>/</span> -->
  <!--        <p class="plan-type">Monthly</p>-->
  <!--      </div>-->
  <!--      <ul class="plan-features">-->
  <!--        <li>Unlimited Templates</li>-->
  <!--        <li>Responsive / Mobile Friendly</li>-->
  <!--        <li>Unlimited Training</li>-->
  <!--        <li>Custom Branding</li>-->
  <!--        <li><span>Resource Library</span></li>-->
  <!--        <li><span>Dedicated Support</span></li>-->
  <!--      </ul>-->
  <!--      <a class="btn btn-info" href="">Select Plan</a>-->
  <!--    </div>-->
      <!-- "Ultmate" Plan -->
  <!--    <div class="pricing-plan">-->
  <!--      <h2 class="plan-title">Ultimate</h2>-->
  <!--      <div class="plan-cost">-->
  <!--        <p class="plan-price">$89</p>-->
  <!--        <span>/</span> -->
  <!--        <p class="plan-type">Monthly</p>-->
  <!--      </div>-->
  <!--      <ul class="plan-features">-->
  <!--        <li>Unlimited Templates</li>-->
  <!--        <li>Responsive / Mobile Friendly</li>-->
  <!--        <li>Unlimited Training </li>-->
  <!--        <li>Custom Branding</li>-->
  <!--        <li>Resource Library</li>-->
  <!--        <li>Dedicated Support</li>-->
  <!--      </ul>-->
  <!--      <a class="btn btn-info" href="">Select Plan</a>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</section>-->

    </div>
        <!--<div class="box-footer">-->
        <!--  <a href="<?php echo base_url('admin')?>" class="btn btn-danger">Dashboard</a>-->
        <!--</div>    -->
      </div>
    </div>
  </div>
