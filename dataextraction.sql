#select distinct dbo_tblmembers.* from tryppp left join dbo_tblmembers on tryppp.NRIC = dbo_tblmembers.NRIC where tryppp.NRIC <>'' order by tryppp.No asc
#select * from dbo_tblmembers where NRIC='S6922848H'
#select (select * from dbo_tblmembers where tryppp.NRIC = dbo_tblmembers.NRIC),* from tryppp
#CREATE TEMPORARY TABLE tmptable select distinct dbo_tblmembers.* from tryppp left join dbo_tblmembers on tryppp.NRIC = dbo_tblmembers.NRIC where tryppp.NRIC <>'' and dbo_tblmembers.MemberCode <>''  order by tryppp.No asc
#select distinct dbo_tblmembers.* from tryppp left join dbo_tblmembers on tryppp.NRIC = dbo_tblmembers.NRIC where tryppp.NRIC <>'' and dbo_tblmembers.MemberCode <>''  order by tryppp.No asc
select tmptable.MemberName,tmptable.NRIC,sum(AmountPaid) 
from tmptable left join dbo_tblmember_packages on dbo_tblmember_packages.MemberCode = tmptable.MemberCode
group by tmptable.NRIC 