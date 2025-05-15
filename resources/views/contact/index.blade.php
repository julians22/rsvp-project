@extends('layouts.app')

@php
    // Meta Desc (clean_description) limit text upto 160 characters
    $metaDesc = 'Contact us at Designcub3 for any inquiry or feedback.';
@endphp

@section('head', 'Contact us')
@section('description', $metaDesc)


@section('page')


    <section class="flex min-h-dvh flex-row space-x-5 bg-landing bg-bottom bg-no-repeat py-14">
        <div class="mx-auto w-full max-w-none px-4 lg:max-w-5xl lg:px-0">

            <div class="mx-8 mb-10 flex items-center justify-between gap-4 max-sm:items-end sm:mb-20 md:mx-16">
                <div class="inline-flex shrink-0 grow-0 basis-2/5 flex-row items-center gap-4 sm:basis-40">
                    <div><img src="{{ asset('img/logo-bni.png') }}" alt="bni logo"></div>
                </div>
                <div class="inline-flex w-full items-center max-sm:basis-3/5 max-sm:flex-col md:justify-between">
                    <div class="max-w-48 sm:max-w-72"><img src="{{ asset('img/LogoChapter.png') }}" alt="Logo Chapter"></div>
                    <div class="max-w-48 sm:max-w-72"><img src="{{ asset('img/impactful.png') }}" alt="text impactful">
                    </div>
                </div>
            </div>

            <div class="mx-8 md:mx-16">
                <h1
                    class="mb-12 inline-block w-max text-3xl font-bold uppercase text-black after:mt-6 after:block after:h-1 after:w-1/4 after:border-t-0 after:bg-red-bni max-md:text-center max-md:after:mx-auto md:after:w-1/6 lg:text-4xl">
                    Contact us</h1>

                @if (session()->has('success'))
                    <div class="mb-4 flex items-center justify-between rounded-md bg-green-500 px-4 py-2 text-white">
                        <span>{{ session('success') }}</span>
                        <button class="text-white" type="button" onclick="this.parentElement.remove();">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                @endif

                <form class="flex flex-col space-y-4" action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <x-input-text name="fullname" label="Full Name" placeholder="John Doe" required />
                    <x-input-text name="businessClassification" label="Business Classification"
                        placeholder="Software Development" required />
                    <x-input-text name="companyName" label="Company Name" placeholder="Designcub3" required />
                    <x-input-text name="email" label="Email" placeholder="john@example.com" type="email" required />
                    <x-input-text name="phone" label="Phone" placeholder="+62 812 3456 7890" required />
                    <x-input-textarea name="message" label="Message" placeholder="Type your message here..." required />
                    <button class="w-min self-end rounded-md bg-red-bni px-4 py-2 font-bold text-white"
                        type="submit">Send</button>
                </form>

            </div>

        </div>
    </section>


@endsection
