<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $resume['name'] }}</title>
  <style>
    h4 {
      font-size: 21px;
    }

    h3 {
      font-size: 23px;
    }

    h2 {
      font-size: 26px;
    }

    h1 {
      font-size: 29px;
    }

    .text-center {
      text-align: center;
    }
  </style>
</head>

<body>
  <h2 class="text-center">{{ $user['name'] }}</h2>
  <h4 class="text-center">Email: {{ $user['email'] }}</h4>
  @if($resume['phone'])
  <h4 class="text-center">Phone: +{{ $resume['phone'] }}</h4>
  @endif
  @if($resume['address'])
  <h4 class="text-center">Address: {{ $resume['address'] }}</h4>
  @endif

  @if (count($experiences) > 0)
  <h3 class="text-center">Work experience</h3>
  @foreach ($experiences as $experience)
  <h4>{{ $experience['company'] }} | @if($experience['location'])
    {{ $experience['location'] }}
    @endif</h4>
  <h4>{{ $experience['role'] }} - {{ $experience['type'] }}| {{ $experience['start_date'] }}
    @if($experience['end_date'])
    -- {{ $experience['end_date'] }}
    @endif</h4>
  <p>{{ $experience['description'] }}</p>
  @endforeach
  @endif

  @if (count($educations) > 0)
  <h3 class="text-center">Education</h3>
  @foreach ($educations as $education)
  <h4>{{ $education['company'] }} | @if($education['location'])
    {{ $education['location'] }}
    @endif</h4>
  <h4>{{ $education['role'] }} | {{ $education['start_date'] }} @if($education['end_date'])
    -- {{ $education['end_date'] }}
    @endif</h4>
  <p>{{ $education['description'] }}</p>
  @endforeach
  @endif
</body>

</html>