<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		@font-face {
		    font-family: 'Carlito';
		    src: url({{ storage_path('fonts/Carlito-Regular.ttf') }}) format("truetype");
		    font-weight: 400;
		    font-style: normal;
		}
        body {
            font-family: 'Carlito';
        }
    </style>
</head>
<body>
	<div style="margin-top:5px; margin-left: 10px; ">
		<div>
			<img src="https://termsheets.lendingfusiongroup.com/images/Group-4.png" height="40">
		</div>
		<div style="margin-top:5px; font-size: smaller;">
			<a href="https://lendingfusiongroup.com/" style="text-decoration: none; color: inherit;">https://lendingfusiongroup.com/</a>
		</div>
		<div style="margin-top:15px;">
			<b>Official Conditional Approval</b>
		</div>
		<div style="margin-top:15px;">
			<b>Date: </b><span style="font-family: 'Times New Roman';">{{now()->format('m/d/Y')}}</span>
		</div>
		<div style="margin-top:5px;">
			<b>Applicant: </b><span style="font-family: 'Times New Roman'; text-transform: uppercase;">{{$data['merchant_name']}}</span>
		</div>
		<div style="margin-top:5px;">
			<b>Owner(s): </b><span style="font-family: 'Times New Roman'; text-transform: uppercase;">{{$data['first_name']}} {{$data['last_name']}}</span>
		</div>
		<div style="margin-top:5px;">
			<b>Address: </b><span style="font-family: 'Times New Roman'; text-transform: uppercase;">{{$data['address']}}</span>
		</div>
		<div style="margin-top:15px;">
			<span style="font-family: 'Times New Roman';">(Expected Loan described as follows):</span>
		</div>
		<div style="margin-top:5px;">
			<b>Net Loan Amount: </b><span style="font-family: 'Times New Roman';">${{number_format(str_replace(",","",$data['net_loan_amount']),2)}}</span>
		</div>
		<div style="margin-top:5px;">
			<b>Loan Amount: </b><span style="font-family: 'Times New Roman';">${{number_format(str_replace(",","",$data['loan_amount']),2)}}</span>
		</div>
		<div style="margin-top:5px;">
			<b>Origination Fee: </b><span style="font-family: 'Times New Roman';">{{$data['origination_fee']}}%</span>
		</div>
		<div style="margin-top:5px;">
			<b>Monthly Payment: </b><span style="font-family: 'Times New Roman';">${{number_format(str_replace(",","",$data['monthly_payment']),2)}}</span>
		</div>
		<div style="margin-top:5px;">
			<b>Interest Rate: </b><span style="font-family: 'Times New Roman';">{{$data['interest_rate']}}%</span>
		</div>
		<div style="margin-top:5px;">
			<b>Loan Type and Program: </b><span style="font-family: 'Times New Roman';">{{$data['loan_type_program']}} -{{$data['loan_type_program_type']}}</span>
		</div>
		<div style="margin-top:5px;">
			<b>Additional Financing Available: </b><span style="font-family: 'Times New Roman';">{{$data['additional_financing_available']}}</span>
		</div>
		<div style="margin-top:5px;">
			<b>Use of Funds: </b> <span style="font-family: 'Times New Roman';">Working Capital</span>
		</div>
		<div style="margin-top:25px;">
			<b>Verified applicant's Income </b><span style="font-family: 'Times New Roman';"> <u>X</u> Yes O No</span>
		</div>
		<div style="margin-top:5px;">
			<span style="font-family: 'Times New Roman';"><b>Verified applicant's Business Credit:</b> __Yes X No</span>
		</div>
		<div style="margin-top:5px;">
			<span style="font-family: 'Times New Roman';"><b>Reviewed applicant's debts and other assets:</b> X Yes _No _ Not applicable</span>
		</div>
		<div style="margin-top:5px;">
			<span style="font-family: 'Times New Roman';"><b>The subject business condition meets the lenders requirements. :</b> <u>X</u> Yes O No</span>
		</div>
		<div style="margin-top:25px;">
			<span style="font-family: 'Times New Roman';">*Once the applicant has made {{ $data['mca_payment'] }} MCA payments, the loan will transition directly into a term loan, with the option to
			convert it into a line of credit if desired.</span>
		</div>
		<div style="margin-top:5px;">
			<span style="font-family: 'Times New Roman';">*Applicant is pre-approved for the loan provided that the applicant's creditworthiness and
				financial position does not materially change and provided that:</span>
		</div>
		<div style="margin-top:20px;">
			<b>Documents Needed: </b><br>
			<span style="margin-left:50px; font-family: 'Times New Roman';">1) AR and AP</span><br>
			<span style="margin-left:50px; font-family: 'Times New Roman';">2) MCA contract with {{ $data['mca_payment'] }} verified payments</span>
		</div>
		<div style="margin-top:10px;">
			<span style="font-family: 'Times New Roman';">Expedited Funding Date Before: {{ now()->addDays(45)->format('m/d/Y') }}</span>
		</div>
		<div style="margin-top:10px;">
			<span style="font-size:15px; font-family: 'Times New Roman';">ALL FINANCIAL INFORMATION PROVIDED IS ACCURATE TO THE BEST OF MY KNOWLEDGE:</span>
		</div>
		<div style="margin-top:25px;">
			<span style="font-family: 'Times New Roman';">X________________________</span>
		</div>
		<div style="margin-top:17px;">
		<span style="font-family: 'Times New Roman'; text-transform: uppercase;">{{$data['merchant_name']}}</span>
		</div>
		<div style="margin-top:17px;">
			<b>Authorized Signer:</b> <span style="font-family: 'Times New Roman'; text-transform: uppercase;">{{$data['first_name']}} {{$data['last_name']}}</span>
		</div>
	</div>
</body>
</html>
