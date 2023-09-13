<div class="outer-container" style="background-color: lightgray;
    display: flex; justify-content: center; align-items: center;
    height: 400px;">

    <div class="container" style="background-color: white;
        padding: 60px;
        border-radius: 10px;
        max-width: 60%;
        max-height: 60%;
        margin: auto;">

        <b>Dear {{$email}},</b><br>

        <p>I hope you are doing great. We want to understand what motivates you,
            what challenges you've overcome, and what goals you want to achieve.
            We want to get to know the person behind the resume.
            We look forward to communicating more with you. For more information visit our page; </p><br>

        {{--<button onclick="href = 'https://www.linkedin.com/in/tamanna-akter-79a8981a8/';">Profile</button><br>--}}
        <a href="https://www.linkedin.com/in/tamanna-akter-79a8981a8/" class="button" style="display: inline-block;
            padding: 8px 15px;
            background-color: steelblue;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 16px;">Linkedin</a><br><br>


        Thanks,<br>
        <b>{{ config('app.name') }}</b>

    </div>

</div>

