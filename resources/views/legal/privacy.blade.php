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
        <h1 style="margin-top: 90px;">@lang('privacy.title')</h1>

        <p><strong>@lang('privacy.lastChange')</strong></p>

        <p>@lang('privacy.welcome')</p>

        <h2>@lang('privacy.dataTypeTitle')</h2>
        <ul>
            <li>@lang('privacy.dataTypes.name')</li>
            <li>@lang('privacy.dataTypes.email')</li>
            <li>@lang('privacy.dataTypes.username')</li>
            <li>@lang('privacy.dataTypes.password')</li>
        </ul>

        <h2>@lang('privacy.dataUseTitle')</h2>
        <ul>
            <li>@lang('privacy.dataUse.courseOrganization')</li>
            <li>@lang('privacy.dataUse.communication')</li>
            <li>@lang('privacy.dataUse.security')</li>
        </ul>

        <h2>@lang('privacy.dataSharingTitle')</h2>
        <p>@lang('privacy.dataSharing')</p>
        <ul>
            <li>@lang('privacy.authorizedPersonnel')</li>
        </ul>

        <h2>@lang('privacy.dataSecurityTitle')</h2>
        <p>@lang('privacy.dataSecurity')</p>

        <h2>@lang('privacy.accessControlTitle')</h2>
        <p>@lang('privacy.accessControl')</p>

        <h2>@lang('privacy.privacyChangesTitle')</h2>
        <p>@lang('privacy.privacyChanges')</p>

        <p>@lang('privacy.thanks')</p>
    </div>

</body>

</html>