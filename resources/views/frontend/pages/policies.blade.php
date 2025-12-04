@extends('frontend.layouts.master')

@section('title','Majira || Policies')

@section('main-content')

	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="javascript:void(0)">Policies</a></li> 
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Policy Page -->
	<section class="policy-page section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-12">

					<div class="single-policy">
						<h1 class="mb-4 text-center">Majira – Return &amp; Exchange Policies</h1>
						<p class="mb-4 text-center">
							At <strong>Majira</strong>, we truly value your trust and want you to have a smooth and delightful shopping experience.
							If something is not right with your order, we are here to assist you with care.
						</p>

						<hr>

						{{-- INDIA POLICY --}}
						<h2 class="mt-4 mb-3">🇮🇳 Majira – Return &amp; Exchange Policy (India)</h2>

						<h3 class="mt-3 mb-2">🌼 5-Day Return Policy</h3>
						<ul>
							<li>You may request a return within <strong>5 days</strong> of receiving your order.</li>
							<li>Returns are accepted only if the product is <strong>unused, undamaged</strong>, and in its <strong>original packaging</strong>.</li>
							<li>
								In case you receive a damaged or incorrect item, please share a
								<strong>complete unboxing video (without cuts)</strong> along with clear photos
								so we can help you quickly.
							</li>
							<li>
								Once the product is received and verified, your refund will be processed within
								<strong>3–7 working days</strong>.
							</li>
						</ul>

						<h3 class="mt-3 mb-2">🌼 7-Day Exchange Policy</h3>
						<ul>
							<li>You may request an exchange within <strong>7 days</strong> of delivery.</li>
							<li>
								Exchange is available for <strong>manufacturing defects, size or color issues</strong>,
								or if an <strong>incorrect product</strong> is delivered (subject to stock availability).
							</li>
							<li>Please share the unboxing video and pictures to initiate the exchange process.</li>
							<li>Exchange will be completed after the product passes our quality check.</li>
						</ul>

						<h3 class="mt-3 mb-2">🌼 Important Notes (India)</h3>
						<ul>
							<li>We kindly request an <strong>unboxing video</strong> for all return or exchange requests.</li>
							<li>Products must be returned with all original <strong>tags, accessories, and packaging</strong>.</li>
							<li>Used, damaged, or tampered products may not qualify for return or exchange.</li>
							<li>
								For hygiene reasons, <strong>earrings</strong> are only eligible for return if they arrive
								<strong>damaged or incorrect</strong>.
							</li>
							<li>Reverse pickup availability may vary depending on your location.</li>
						</ul>

						<h3 class="mt-3 mb-2">🌼 How to Initiate a Return/Exchange (India)</h3>
						<ol>
							<li>Contact us through our website, WhatsApp, or email within the applicable timeline.</li>
							<li>Share your order details, unboxing video, and photos of the issue you are facing.</li>
							<li>Our support team will guide you step-by-step and arrange the process as smoothly as possible.</li>
						</ol>

						<hr>

						{{-- INTERNATIONAL POLICY --}}
						<h2 class="mt-4 mb-3">🌍 Majira – International Return &amp; Exchange Policy (Outside India)</h2>

						<p>
							At <strong>Majira</strong>, we are grateful to serve customers across the globe.
							We want every shopping experience to be smooth, safe, and satisfying.
							If you face any concerns with your order, we are here to help with care.
						</p>

						<h3 class="mt-3 mb-2">🌍 Return &amp; Exchange Request Timeline</h3>
						<ul>
							<li>
								International customers must inform us about any damage or exchange request within
								<strong>7 days</strong> of receiving the product.
							</li>
							<li>
								Kindly share a proper <strong>unboxing video (full video without cuts)</strong> and clear photos
								showing the issue.
							</li>
							<li>Requests made after 7 days may not be eligible.</li>
						</ul>

						<h3 class="mt-3 mb-2">🌍 Processing &amp; Shipping Timeline (20–25 Days)</h3>
						<ul>
							<li>
								Once your return/exchange request is approved and the product is shipped back to us,
								the complete exchange process may take <strong>20–25 days</strong>, depending on
								international shipping timelines and customs clearance.
							</li>
							<li>We truly appreciate your patience, as international logistics require additional time.</li>
						</ul>

						<h3 class="mt-3 mb-2">🌍 Return Policy (International Orders)</h3>
						<ul>
							<li>Products must be <strong>unused, unworn</strong>, and returned with original packaging, tags, and accessories.</li>
							<li>Refunds are initiated only after the product is received and passes our quality check.</li>
							<li>
								Depending on the country, <strong>return shipping charges</strong> may be borne by the customer
								unless the product shipped by us was damaged or incorrect.
							</li>
						</ul>

						<h3 class="mt-3 mb-2">🌍 Exchange Policy (International Orders)</h3>
						<ul>
							<li>
								Exchanges are offered for <strong>manufacturing defects, incorrect product received</strong>,
								or eligible <strong>design/size issues</strong> (subject to availability).
							</li>
							<li>The exchange will be dispatched once the returned item is received and verified.</li>
						</ul>

						<h3 class="mt-3 mb-2">🌍 Important Notes for International Customers</h3>
						<ul>
							<li>No request will be accepted without a valid <strong>unboxing video</strong>.</li>
							<li>Products that appear used, altered, or damaged by the customer are not eligible.</li>
							<li>
								<strong>Earrings</strong> can only be returned/exchanged if they arrive
								<strong>damaged or incorrect</strong>, due to hygiene reasons.
							</li>
							<li>Shipping times may vary based on country and courier delays.</li>
						</ul>

						<h3 class="mt-3 mb-2">🌍 How to Initiate a Return/Exchange (International)</h3>
						<ol>
							<li>Contact us within <strong>7 days</strong> of receiving your order.</li>
							<li>Share your order number, unboxing video, and photos of the issue.</li>
							<li>Our team will guide you with the next steps and return instructions.</li>
							<li>Once the product reaches us, the process may take <strong>20–25 days</strong> to complete.</li>
						</ol>

						<hr>

						<p class="mt-4 mb-0 text-center">
							If you have any questions, feel free to reach out to the <strong>Majira</strong> support team.
							We are always happy to help you. 💛
						</p>

					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- End Policy Page -->

@endsection
