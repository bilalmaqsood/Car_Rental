@component('mail::message')

    <table class="table">
        <tbody>
        <tr>
            <th style="width: 25%; border: none; text-align: left; font-size: 14px; vertical-align: bottom; border-right: 1px solid;">Name:</th>
            <td style="padding-left: 1em;">{{ $form['name'] }}</td>
        </tr>
        <tr>
            <th style="width: 25%; border: none; text-align: left; font-size: 14px; vertical-align: bottom; border-right: 1px solid;">Email Address:</th>
            <td style="padding-left: 1em;">{{ $form['email'] }}</td>
        </tr>
        <tr>
            <th style="width: 25%; border: none; text-align: left; font-size: 14px; vertical-align: bottom; border-right: 1px solid;">Phone number:</th>
            <td style="padding-left: 1em;">{{ isset($form['phone']) ? $form['phone'] : 'no provided' }}</td>
        </tr>
        <tr>
            <th style="width: 25%; border: none; text-align: left; font-size: 14px; vertical-align: bottom; border-right: 1px solid;">Subject:</th>
            <td style="padding-left: 1em;">{{ isset($form['subject']) ? $form['subject'] : 'no provided' }}</td>
        </tr>
        <tr>
            <th style="width: 25%; border: none; text-align: left; font-size: 14px; vertical-align: middle; border-right: 1px solid;">Message:</th>
            <td style="padding-left: 1em;">{{ $form['message'] }}</td>
        </tr>
        </tbody>
    </table>

@endcomponent
