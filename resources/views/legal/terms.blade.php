<!DOCTYPE html>
<html>

<head>
    <title>@lang('shared.title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <x-navbar />
    </header>
    <div style="padding: 30px;">
        <h1 style="margin-top: 90px;">@lang('terms.title')</h1>

        <p><strong>@lang('terms.last_update')</strong></p>
        
        <p>@lang('terms.read_carefully')</p>

        <h2>@lang('terms.acceptance.title')</h2>
        <p>@lang('terms.acceptance.content')</p>

        <h2>@lang('terms.usage.title')</h2>
        <p>@lang('terms.usage.content1')</p>
        <p>@lang('terms.usage.content2')</p>

        <h2>@lang('terms.registration.title')</h2>
        <p>@lang('terms.registration.content1')</p>
        <p>@lang('terms.registration.content2')</p>

        <h2>@lang('terms.intellectual_property.title')</h2>
        <p>@lang('terms.intellectual_property.content')</p>

        <h2>@lang('terms.liability.title')</h2>
        <p>@lang('terms.liability.content')</p>

        <h2>@lang('terms.modifications.title')</h2>
        <p>@lang('terms.modifications.content')</p>

        <h2>@lang('terms.applicable_law.title')</h2>
        <p>@lang('terms.applicable_law.content')</p>

        <p>@lang('terms.contact_information')</p>

        <p>@lang('terms.thanks')</p>
    </div>
</body>

</html>
