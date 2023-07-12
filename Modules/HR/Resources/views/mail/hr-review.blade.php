<div>
    <style>
        .line {
            line-height: 1px;
        },
        .margin-bottom {
            margin-bottom: 25px;
        }
    </style>
    <p class="margin-bottom">Dear, {{ $data['user']['name'] }}</p>
    <p>I hope this email finds you well and in good spirits!</p>
    <p>At ColoredCow our belief is we build great people who do extraordinary things. To facilitate the growth of
        talent, we are on our way to creating a career progression model, which requires a quarterly review of an
        employee based on some holistic growth parameters.</p>
    <p class="margin-bottom">
        As part of this process, we would like to request the HR team to perform an assessment of the employee
        {{ $data['employee']['name'] }} based on their observations and knowledge of an individual's performance. The
        aim of this
        assessment is to
        gain a comprehensive understanding of the employee's performance, strengths, and areas for improvement from the
        HR team's perspective.
    </p>
    <p><a href="{{ $data['review_link'] }}">HR assessment sheet</a></p>
    <h5>Target date: {{ now()->addDays(7)->format('d-m-y') }}</h5>
    <p>We are new to this model and we all need to train ourselves to do a great assessment. That’s why we created a few
        training modules, which you may find helpful and handy.</p>
    <p>&#x2022; <a
            href="https://docs.google.com/presentation/d/1yhYQJaEAxSX7vVOrJEyn7WR3vNqybD_m8nSzoeTf0oE/edit#slide=id.p">Evaluation
            guideline</a>- To run this model for self assessment.</p>
    <p>&#x2022; <a
            href="https://docs.google.com/presentation/d/169wTST4wjzGKvLRhAPq4z8HiB4wkonvelyUqHHQitMk/edit">Training
            model</a>on the holistic growth parameters for all the roles in the organization.</p>
    <h5><i>**The end goal is to educate ColoredCow Remarkables through a method of case studies. Keep visiting this
            training model for new learnings and betterment</i></h5>
    <p>If you have any inputs to make this whole process better or contribute to it, feel free to reach out.</p>
    <p class="margin-bottom">Let’s get better together!</p>
    <p class="line">Regards</p>
</div>
