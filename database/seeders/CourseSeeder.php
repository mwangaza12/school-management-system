<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            'Department of Literature' => [
                ['Introduction to Literature', 'LIT101'],
                ['World Literature', 'LIT102'],
                ['Creative Writing', 'LIT103']
            ],
            'Department of Fine Arts' => [
                ['Introduction to Fine Arts', 'ART101'],
                ['Painting', 'ART102'],
                ['Sculpture', 'ART103']
            ],
            'Department of History' => [
                ['World History', 'HIS101'],
                ['Ancient Civilizations', 'HIS102'],
                ['Modern History', 'HIS103']
            ],
            'Department of Philosophy' => [
                ['Introduction to Philosophy', 'PHI101'],
                ['Ethics', 'PHI102'],
                ['Logic', 'PHI103']
            ],
            'Department of Languages' => [
                ['Spanish', 'LAN101'],
                ['French', 'LAN102'],
                ['German', 'LAN103']
            ],
            'Department of Psychology' => [
                ['Introduction to Psychology', 'PSY101'],
                ['Developmental Psychology', 'PSY102'],
                ['Clinical Psychology', 'PSY103']
            ],
            'Department of Sociology' => [
                ['Introduction to Sociology', 'SOC101'],
                ['Sociological Theory', 'SOC102'],
                ['Social Research Methods', 'SOC103']
            ],
            'Department of Economics' => [
                ['Microeconomics', 'ECO101'],
                ['Macroeconomics', 'ECO102'],
                ['Econometrics', 'ECO103']
            ],
            'Department of Political Science' => [
                ['Introduction to Political Science', 'POL101'],
                ['International Relations', 'POL102'],
                ['Political Theory', 'POL103']
            ],
            'Department of Anthropology' => [
                ['Cultural Anthropology', 'ANT101'],
                ['Physical Anthropology', 'ANT102'],
                ['Archaeology', 'ANT103']
            ],
            'Department of Biology' => [
                ['General Biology', 'BIO101'],
                ['Genetics', 'BIO102'],
                ['Ecology', 'BIO103']
            ],
            'Department of Chemistry' => [
                ['General Chemistry', 'CHE101'],
                ['Organic Chemistry', 'CHE102'],
                ['Analytical Chemistry', 'CHE103']
            ],
            'Department of Physics' => [
                ['General Physics', 'PHY101'],
                ['Quantum Mechanics', 'PHY102'],
                ['Thermodynamics', 'PHY103']
            ],
            'Department of Mathematics' => [
                ['Calculus I', 'MAT101'],
                ['Linear Algebra', 'MAT102'],
                ['Statistics', 'MAT103']
            ],
            'Department of Computer Science' => [
                ['Introduction to Programming', 'CSC101'],
                ['Data Structures', 'CSC102'],
                ['Operating Systems', 'CSC103']
            ],
            'Department of Mechanical Engineering' => [
                ['Thermodynamics', 'MEE101'],
                ['Fluid Mechanics', 'MEE102'],
                ['Machine Design', 'MEE103']
            ],
            'Department of Electrical Engineering' => [
                ['Circuit Analysis', 'ELE101'],
                ['Electromagnetics', 'ELE102'],
                ['Control Systems', 'ELE103']
            ],
            'Department of Civil Engineering' => [
                ['Structural Analysis', 'CIV101'],
                ['Geotechnical Engineering', 'CIV102'],
                ['Transportation Engineering', 'CIV103']
            ],
            'Department of Chemical Engineering' => [
                ['Chemical Process Principles', 'CHEE101'],
                ['Reaction Engineering', 'CHEE102'],
                ['Process Design', 'CHEE103']
            ],
            'Department of Aerospace Engineering' => [
                ['Aerodynamics', 'AER101'],
                ['Flight Mechanics', 'AER102'],
                ['Spacecraft Design', 'AER103']
            ],
            'Department of Management' => [
                ['Principles of Management', 'MAN101'],
                ['Organizational Behavior', 'MAN102'],
                ['Strategic Management', 'MAN103']
            ],
            'Department of Finance' => [
                ['Corporate Finance', 'FIN101'],
                ['Investment Analysis', 'FIN102'],
                ['Financial Markets', 'FIN103']
            ],
            'Department of Marketing' => [
                ['Principles of Marketing', 'MKT101'],
                ['Consumer Behavior', 'MKT102'],
                ['Marketing Research', 'MKT103']
            ],
            'Department of Accounting' => [
                ['Financial Accounting', 'ACC101'],
                ['Managerial Accounting', 'ACC102'],
                ['Auditing', 'ACC103']
            ],
            'Department of Entrepreneurship' => [
                ['Introduction to Entrepreneurship', 'ENT101'],
                ['New Venture Creation', 'ENT102'],
                ['Small Business Management', 'ENT103']
            ],
            'Department of Curriculum and Instruction' => [
                ['Curriculum Development', 'EDU101'],
                ['Instructional Strategies', 'EDU102'],
                ['Assessment Methods', 'EDU103']
            ],
            'Department of Educational Leadership' => [
                ['Leadership in Education', 'EDL101'],
                ['School Administration', 'EDL102'],
                ['Educational Policy', 'EDL103']
            ],
            'Department of Special Education' => [
                ['Introduction to Special Education', 'SPE101'],
                ['Learning Disabilities', 'SPE102'],
                ['Inclusive Education', 'SPE103']
            ],
            'Department of Counseling' => [
                ['Introduction to Counseling', 'COU101'],
                ['Counseling Theories', 'COU102'],
                ['Group Counseling', 'COU103']
            ],
            'Department of Educational Psychology' => [
                ['Educational Psychology', 'EDP101'],
                ['Human Development', 'EDP102'],
                ['Motivation in Education', 'EDP103']
            ],
            'Department of Medicine' => [
                ['Anatomy', 'MED101'],
                ['Physiology', 'MED102'],
                ['Pathology', 'MED103']
            ],
            'Department of Nursing' => [
                ['Fundamentals of Nursing', 'NUR101'],
                ['Pediatric Nursing', 'NUR102'],
                ['Adult Health Nursing', 'NUR103']
            ],
            'Department of Public Health' => [
                ['Introduction to Public Health', 'PH101'],
                ['Epidemiology', 'PH102'],
                ['Health Policy', 'PH103']
            ],
            'Department of Pharmacy' => [
                ['Pharmacology', 'PHA101'],
                ['Medicinal Chemistry', 'PHA102'],
                ['Pharmacy Practice', 'PHA103']
            ],
            'Department of Dentistry' => [
                ['Dental Anatomy', 'DEN101'],
                ['Oral Pathology', 'DEN102'],
                ['Clinical Dentistry', 'DEN103']
            ],
            'Department of Legal Studies' => [
                ['Introduction to Law', 'LAW101'],
                ['Legal Research', 'LAW102'],
                ['Legal Writing', 'LAW103']
            ],
            'Department of Criminal Law' => [
                ['Criminal Law', 'CRL101'],
                ['Criminal Procedure', 'CRL102'],
                ['Juvenile Justice', 'CRL103']
            ],
            'Department of Civil Law' => [
                ['Civil Procedure', 'CIVL101'],
                ['Contracts', 'CIVL102'],
                ['Torts', 'CIVL103']
            ],
            'Department of International Law' => [
                ['International Law', 'INL101'],
                ['Human Rights Law', 'INL102'],
                ['International Trade Law', 'INL103']
            ],
            'Department of Constitutional Law' => [
                ['Constitutional Law', 'CON101'],
                ['Administrative Law', 'CON102'],
                ['Comparative Constitutional Law', 'CON103']
            ],
            'Department of Agriculture' => [
                ['Introduction to Agriculture', 'AGR101'],
                ['Crop Science', 'AGR102'],
                ['Animal Science', 'AGR103']
            ],
            'Department of Environmental Science' => [
                ['Environmental Science', 'ENV101'],
                ['Environmental Policy', 'ENV102'],
                ['Sustainable Development', 'ENV103']
            ],
            'Department of Forestry' => [
                ['Forest Ecology', 'FOR101'],
                ['Forest Management', 'FOR102'],
                ['Wildlife Conservation', 'FOR103']
            ],
            'Department of Horticulture' => [
                ['Horticultural Science', 'HOR101'],
                ['Plant Propagation', 'HOR102'],
                ['Landscape Design', 'HOR103']
            ],
            'Department of Soil Science' => [
                ['Soil Science', 'SOI101'],
                ['Soil Fertility', 'SOI102'],
                ['Soil Conservation', 'SOI103']
            ],
            'Department of Journalism' => [
                ['Introduction to Journalism', 'JOU101'],
                ['News Writing', 'JOU102'],
                ['Media Ethics', 'JOU103']
            ],
            'Department of Public Relations' => [
                ['Introduction to Public Relations', 'PR101'],
                ['PR Campaigns', 'PR102'],
                ['Crisis Communication', 'PR103']
            ],
            'Department of Broadcasting' => [
                ['Broadcasting', 'BRC101'],
                ['Television Production', 'BRC102'],
                ['Radio Journalism', 'BRC103']
            ],
            'Department of Advertising' => [
                ['Advertising Principles', 'ADV101'],
                ['Advertising Strategy', 'ADV102'],
                ['Creative Advertising', 'ADV103']
            ],
            'Department of Communication Studies' => [
                ['Introduction to Communication Studies', 'COM101'],
                ['Interpersonal Communication', 'COM102'],
                ['Media Studies', 'COM103']
            ]
        ];

        foreach ($courses as $department_name => $department_courses) {
            $department = Department::where('name', $department_name)->first();
            foreach ($department_courses as $course) {
                Course::create([
                    'name' => $course[0],
                    'code' => $course[1],
                    'department_id' => $department->id
                ]);
            }
        }
    }
}
