<?php
session_start();
if($_SESSION["access"] === true){
    include("header.php");
?>
    <div id="main">
        <h4 class="st-xlarge st-text-grey" id="policy_notice_title">Privacy Policy Notice</h4>

        <p id="policy_notice">The policy:<br />
            This privacy policy notice is served by
            'dylan-baker.software' under the website;
            <a href="www.dylan-baker.software/cmp400/index.php">www.dylan-baker.software</a>.
            The purpose of this policy is to explain to you how we control, process,
            handle and protect your personal
            information through the business and while you browse or use this website.
            If you do not agree to the following policy you may wish to cease viewing / using this website,
            and or refrain from submitting your personal data to us.</p>

        <h4 id="policy_key_title">Policy key definitions:</h4>
        <ul class="policy_key_list">
            <li>"I", "our", "us", or "we" refer to the business, [Business name & other trading names].</li>
            <li>"you", "the user" refer to the person(s) using this website.</li>
            <li>GDPR means General Data Protection Act.</li>
        </ul>

        <h4 id="key_principle_title">Key principles of GDPR:</h4>
        <p id="key_principles">Our privacy policy embodies the following key principles; (a) Lawfulness, fairness and transparency,
            (b) Purpose limitation, (c) Data minimisation, (d) Accuracy, (e) Storage limitation,
            (f) Integrity and confidence, (g) Accountability.</p>

        <h4 id="processing_title">Processing of your personal data</h4>
        <p id="processing">Under the GDPR (General Data Protection Regulation)
            we control and / or process any personal information about you electronically using the following lawful bases.</p>
        <ul id="processing_list">
            <li>We are registered with the ICO under the Data Protection Register, our registration number is: 123456.</li>
        </ul>

        <p>If, as determined by us, the lawful basis upon which we process your personal information changes, we will notify you
            about the change and any new lawful basis to be used if required. We shall stop processing your personal information
            if the lawful basis used is no longer relevant.</p>

        <h4 id="individual_rights_title">Your individual rights</h4>

        <p>Under the GDPR your rights are as follows. You can read more about your rights in details here;</p>

        <ul class="individual_rights_list">
            <li class="rights_list">the right to rectification;</li>
            <li class="rights_list">the right to erasure;</li>
            <li class="rights_list">the right to restrict processing;</li>
        </ul>

        <p>You also have the right to complain to the ICO [<a href="www.ico.org.uk">www.ico.org.uk</a>]
            if you feel there is a problem with the way we are handling your data.</p>
        <p>We handle subject access requests in accordance with the GDPR.</p>

        <h4>We store the following data;</h4>

        <ul class="cookietext">
            <li>All created site names and passwords under OnlyPass (encrypted)</li>
            <li>User account information (name, email, password(hashed))</li>
        </ul>

        <h4>Data security and protection</h4>
        <p>We ensure the security of any personal information we hold by using secure data storage technologies and
            precise procedures in how we store, access and manage that information. Our methods meet the GDPR compliance requirement.</p>
    </div>

<script>
    function readCookie(name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');
        for(let i=0;i < ca.length;i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1,c.length);
            }
            if (c.indexOf(nameEQ) === 0) {
                return c.substring(nameEQ.length,c.length);
            }
        }
        return null;
    }

    let cookieuser = readCookie("user");
    if (cookieuser != null) {
        let List1 = document.querySelector('ul.policy_key_list');
        let List2 = document.querySelector('ul.individual_rights_list');
        let List3 = document.querySelector('li.rights_list');
        let List4 = document.querySelector('ul.cookietext');

        let entry1 = document.createElement('li');
        let entry2 = document.createElement('li');
        let entry3 = document.createElement('li');
        let entry4 = document.createElement('li');
        let entry5 = document.createElement('li');
        let entry6 = document.createElement('li');
        let entry7 = document.createElement('li');
        let entry8 = document.createElement('li');
        let entry9 = document.createElement('li');

        entry1.textContent = 'PECR means Privacy & Electronic Communications Regulation. ';
        entry2.textContent = 'ICO means Information Commissioner\'s Office. ';
        entry3.textContent = 'Cookies mean small files stored on a users computer or device. ';
        entry4.textContent = 'the right to be informed; ';
        entry5.textContent = 'the right of access; ';
        entry6.textContent = 'the right to data portability; ';
        entry7.textContent = 'the right to object; and ';
        entry8.textContent = 'the right not to be subject to automated decision-making including profiling. ';
        entry9.textContent = 'User Log-in cookie (Stores User Log-in data)';

        List1.appendChild(entry1);
        List1.appendChild(entry2);
        List1.appendChild(entry3);
        List2.insertBefore(entry4, List3);
        List2.insertBefore(entry5, List3);
        List2.appendChild(entry6);
        List2.appendChild(entry7);
        List2.appendChild(entry8);
        List4.appendChild(entry9);
    }
</script>

<?php
include("footer.php");
}
else {
    header("HTTP/1.0 405 Method Not Allowed");
}
?>