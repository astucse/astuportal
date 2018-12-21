<?php

namespace Modules\StaffEvaluation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $item3 = [
            ['question_english'=>'Explains course overall objectives, prepares course outline on time and explains the contents of the course outline','question_amharic'=>'የትምህርቱን ዓላማ፣ዝርዝር ይዘት/ ኮርስ አውትላይን/ በግልፅ ያሳውቃል፤ በጊዜ ሰሌዳ መጥኖ ያዘጋጃል፣ያቀርባል፣ለተማሪው አባዝቶ ይሰጣል','type'=>'rate','evaluation_id'=>1,'question_category_id'=>1],
            ['question_english'=>'Prepares well for course delivery','question_amharic'=>'ስለሚያስተምረው ትምህርት ተገቢ ዝግጅት አድርጎ በትምህርቱ ዝርዝር ይዘት መሠረት ያቀርባል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>1],
            ['question_english'=>'Gives course reading materials and lecture notes','question_amharic'=>'ለሚያስተምረው ትምህርት አስፈላጊ ጽሁፎችን አዘጋጅቶ ይመጣል፡፡','type'=>'rate','evaluation_id'=>1,'question_category_id'=>1],
            ['question_english'=>'Notify list of references and textbooks available in the library','question_amharic'=>'ለሚያስተምረው ትምህርት ጠቃሚ የሆኑትን በቤተመፅሐፍት ዉስጥ ያሉ ማጣቀሻ መፃህፍት ዝርዝር (Reference) አዘጋጅቶ ለተማሪዎች ይሰጣል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>1],
            ['question_english'=>'Depending on course nature teaches practical sessions','question_amharic'=>'እንደአስፈላጊነቱ የተግባር ልምምድ ይሰጣል፣ (ዎርክሾፕ፣ ላቦራቶሪ፣ የመስክ ጉብኝት፣ case study ወዘተ..) ','type'=>'rate','evaluation_id'=>1,'question_category_id'=>1],
            ['question_english'=>'','question_amharic'=>'በሚያስተምረውን ትምህርት ላይ መሰረታዊና በቂ ዕወቀት አለው፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>1],

            ['question_english'=>'','question_amharic'=>'ትምህርቱን በማስተማሪያ ቋንቋ በመጠቀም ተማሪዎች በሚረዱ መልኩ በግልጽ ያቀርባል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>2],
            ['question_english'=>'','question_amharic'=>'የተለያዩ የትምህርት መርጃ መሣሪያዎችን በመጠቀም ያስተምራል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>2],
            ['question_english'=>'','question_amharic'=>'ለትምህርቱ ጠቃሚ የሆኑ መልመጃዎችን ይሰጣል፤ ያርማል/Class work, Homework, queez,…etc፣ ግብረ መልስ ይሰጣል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>2],
            ['question_english'=>'','question_amharic'=>'በመተባበር መማር (COOPERATIVE LEARNING) አደረጃጀት ወይም የቡድን ሰራ በክፍል ውስጥ አሳታፊ የስነ ማስተማር ዘዴ ተጠቅሞ ያስተምራል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>2],
            ['question_english'=>'','question_amharic'=>'ተከተታታይ ምዘናን በትክክልና በአግባቡ ይተገብራል፣ የተከተታይ ምዘና ውጤትን ግብረ መልስ በአጭር ጊዜ ውስጥ ይሰጣል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>2],
            ['question_english'=>'','question_amharic'=>'በተከታታይ ምዘና ውጤት መሰረት በትምህርታቸው ዝቅተኛ ውጤት ላመጡ ተማሪዎች ድጋሚ ፈተና ይሰጣል፤','type'=>'rate','evaluation_id'=>1,'question_category_id'=>2],
            ['question_english'=>'','question_amharic'=>'ለሴት ተማሪዎች፣ ከታዳጊ ክልል ለመጡ ተማሪዎች፣ በትምህርታቸው ድጋፍ ለሚሹ ተማሪዎች እና የምዘና ውጤትን መሰረት በማድረግ በውጤታቸው ዝቅ ላሉ ተማሪዎች ቱቶሪያል ይሰጣል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>2],
            ['question_english'=>'','question_amharic'=>'የፈተና ጥያቄዎችን ካስተማረው ትምህርት ጋር አዛምዶ ያወጣል፣ ሁሉንም ርዕሶችን ይዳስሳል፣ የተለያዩ የምዘና አይነቶች ያካትታል፣ በሚሰጣቸው ፈተናዎች ለሚጠቃለሉ ጥያቄዎች ሚዛናዊ የሆነ ዋጋ ይሰጣል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>2],

            ['question_english'=>'','question_amharic'=>'ለተማዎች ተገቢውን ክብር ይሰጣል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>3],
            ['question_english'=>'','question_amharic'=>'በክፍል ውስጥ የተማሪዎችን ጥያቄ ተቀብሎ በአግባቡ ያስተናግዳል፣ በክፍል ውስጥ ተማሪዎች ስለትምህርቱ ሀሳባቸውንና አስተያየታቸውን በነጻነት እንዲገልጹ ይፈቅዳል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>3],
            ['question_english'=>'','question_amharic'=>'በስነ ስርዓት አክባሪነቱ፣ በሚያሳየው ጨዋነቱና እውቀቱን ለማስተላለፍ በሚያሳየው ቅንነትና ተነሳሽነት በአርአያነት ይጠቀሳል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>3],
            ['question_english'=>'','question_amharic'=>'በዘር ፣በሀይማኖትና በፆታ ልዩነት አይፈጥርም፣ ሁሉንም በእኩል ያያል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>3],

            ['question_english'=>'','question_amharic'=>'በተመደበለት የትምህርት ክፍለ ጊዜ ሰዓት አክብሮ ይገኛል፣ ክፍለ ጊዜውን በአግባቡ ለማስተማር ተግባር ያውላል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>4],
            ['question_english'=>'','question_amharic'=>'ተማሪዎችን ለመርዳት የማማከሪያ ሰዓት መድቦ ያሳውቃል፣ በመደበው ሰዓት ተማሪዎች ለሚያቀርቡት የአካዳሚክ ችግሮች መፍትሄ ይፈልጋል፣','type'=>'rate','evaluation_id'=>1,'question_category_id'=>4],

            ['question_english'=>'Strengths of the instructor','question_amharic'=>'በጥንካሬ የሚገለፁ እና አርአያነት ያላቸው ጎኖች ','type'=>'write','evaluation_id'=>1,'question_category_id'=>6],
            ['question_english'=>'Suggested points/aspects the instructor should improve','question_amharic'=>'መምህሩ እንዲያሻሽላቸው የሚገቡ ','type'=>'write','evaluation_id'=>1,'question_category_id'=>6],






            ['question_english'=>'Contribution in preparing and searching for teaching materials','type'=>'rate','evaluation_id'=>2,'question_category_id'=>1],
            ['question_english'=>'Continuous update of the subject matter ','type'=>'rate','evaluation_id'=>2,'question_category_id'=>1],
            ['question_english'=>'Delivering seminars that are relevant to his teaching subject ','type'=>'rate','evaluation_id'=>2,'question_category_id'=>1],
            ['question_english'=>'Level of his/her subject matter knowledge and skill','type'=>'rate','evaluation_id'=>2,'question_category_id'=>1],

            ['question_english'=>'Willingness and level of engagement in community service and volunteer activities','type'=>'rate','evaluation_id'=>2,'question_category_id'=>5],
            ['question_english'=>'Participation on seminars/workshops  at department/ faculty/ institution level during the year','type'=>'rate','evaluation_id'=>2,'question_category_id'=>5],
            ['question_english'=>'Identifying priority areas in one’s discipline and pursuing research in that area and Willingness to help colleagues in identifying areas of research and proposal development','type'=>'rate','evaluation_id'=>2,'question_category_id'=>5],

            ['question_english'=>'Guidance and counseling role to students','type'=>'rate','evaluation_id'=>2,'question_category_id'=>2],
            ['question_english'=>'Contributing constructive ideas and activities that improve the teaching learning process.','type'=>'rate','evaluation_id'=>2,'question_category_id'=>2],
            ['question_english'=>'Participation in  problem  identification and solving at department/college/institution','type'=>'rate','evaluation_id'=>2,'question_category_id'=>2],
            ['question_english'=>'Participation in Comprehensive Continuous Professional Development / CCPD, HDP, ELIP','type'=>'rate','evaluation_id'=>2,'question_category_id'=>2],
            ['question_english'=>'Willingness to actively participate in cooperative learning and team teaching activities  and preparedness to implement change tools','type'=>'rate','evaluation_id'=>2,'question_category_id'=>2],

            ['question_english'=>'Willingness to participate and level of commitment in committee works','type'=>'rate','evaluation_id'=>2,'question_category_id'=>4],
            ['question_english'=>'Willingness to share university resources with other colleagues','type'=>'rate','evaluation_id'=>2,'question_category_id'=>4],
            ['question_english'=>'Showing cordiality to others, respecting ideas of others','type'=>'rate','evaluation_id'=>2,'question_category_id'=>4],
            ['question_english'=>'Having positive attitude to work with others (team spirit)','type'=>'rate','evaluation_id'=>2,'question_category_id'=>4],
            ['question_english'=>'Level of respect to rules, regulations and guidelines of the institution','type'=>'rate','evaluation_id'=>2,'question_category_id'=>4],
            ['question_english'=>'His/her discipline (dressing, addictions, personality etc…)','type'=>'rate','evaluation_id'=>2,'question_category_id'=>4],


            ['question_english'=>'Time management in department Affairs and  in teaching learning activities','type'=>'rate','evaluation_id'=>2,'question_category_id'=>3],
            ['question_english'=>'Time utilization for consultation hours ','type'=>'rate','evaluation_id'=>2,'question_category_id'=>3],


            ['question_english'=>'Strengths of the instructor','type'=>'write','evaluation_id'=>2,'question_category_id'=>6],
            ['question_english'=>'Suggested points/aspects the instructor should improve','type'=>'write','evaluation_id'=>2,'question_category_id'=>6],













            ['question_english'=>'Efforts of self development in his/her specialization','type'=>'rate','evaluation_id'=>3,'question_category_id'=>1],
            ['question_english'=>'Adequacy of subject matter knowledge','type'=>'rate','evaluation_id'=>3,'question_category_id'=>1],
            ['question_english'=>'Professional Skill /Teaching Methodology','type'=>'rate','evaluation_id'=>3,'question_category_id'=>1],
            ['question_english'=>'Willingness to accept additional teaching assignments when compelling situation arises in the department','type'=>'rate','evaluation_id'=>3,'question_category_id'=>1],
            ['question_english'=>'Effectiveness as a mentor in cooperative learning, internship etc...','type'=>'rate','evaluation_id'=>3,'question_category_id'=>1],
            ['question_english'=>'Active participation in improvement of teaching-learning process, seminars. workshop, symposia and reviewing of teaching materials (curriculum) ','type'=>'rate','evaluation_id'=>3,'question_category_id'=>1],
            ['question_english'=>'Participation in community service affairs and volunteer activities and willingness to participate in activities other than regular teaching (mentorship)','type'=>'rate','evaluation_id'=>3,'question_category_id'=>1],
            ['question_english'=>'Identifying priority areas in one’s discipline and pursuing research in that area  ','type'=>'rate','evaluation_id'=>3,'question_category_id'=>1],
            ['question_english'=>'Participation in research project and project proposal development','type'=>'rate','evaluation_id'=>3,'question_category_id'=>1],
            ['question_english'=>'Performance as an academic advisor','type'=>'rate','evaluation_id'=>3,'question_category_id'=>1],

            ['question_english'=>'Participation in  problem  identification and solving at department/college/institution','type'=>'rate','evaluation_id'=>3,'question_category_id'=>2],
            ['question_english'=>'Participation in Comprehensive Continuous Professional Development /CCPD, HDP, ELIP','type'=>'rate','evaluation_id'=>3,'question_category_id'=>2],
            ['question_english'=>'Continuous assessment implementation','type'=>'rate','evaluation_id'=>3,'question_category_id'=>2],
            ['question_english'=>'Providing and reporting tutorial activities designed for the students ','type'=>'rate','evaluation_id'=>3,'question_category_id'=>2],

            ['question_english'=>'Executing assigned classes/invigilation on time.','type'=>'rate','evaluation_id'=>3,'question_category_id'=>3],
            ['question_english'=>'Notifying and implementing consultation timely and Giving  timely feedback to students','type'=>'rate','evaluation_id'=>3,'question_category_id'=>3],
            ['question_english'=>'Meeting deadlines (in reporting, SIMS result feeding, submission of grade/ documents...etc…)','type'=>'rate','evaluation_id'=>3,'question_category_id'=>3],

            ['question_english'=>'Showing concern for the use of resources of the department and the University ','type'=>'rate','evaluation_id'=>3,'question_category_id'=>4],
            ['question_english'=>'Willingness and participation in committee works at department /University level and Having positive attitude to work with others, team spirit','type'=>'rate','evaluation_id'=>3,'question_category_id'=>4],
            ['question_english'=>'His/her professional ethics and being a role model (dressing, hair style, personality, addiction…)','type'=>'rate','evaluation_id'=>3,'question_category_id'=>4],

            ['question_english'=>'Strengths of the instructor','type'=>'write','evaluation_id'=>3,'question_category_id'=>6],
            ['question_english'=>'Suggested points/aspects the instructor should improve','type'=>'write','evaluation_id'=>3,'question_category_id'=>6],

        ];

        foreach ($item3 as $item) {
            if(isset($item['question_amharic'])){
                \Modules\StaffEvaluation\Entities\Question::create([
                    'question_english' => $item['question_english'],
                    'question_amharic' => $item['question_amharic'],
                    'type' => $item['type'],
                    'evaluation_id' => $item['evaluation_id'],
                    'question_category_id' => $item['question_category_id'],
                ]);    
            }else{
                \Modules\StaffEvaluation\Entities\Question::create([
                    'question_english' => $item['question_english'],
                    'type' => $item['type'],
                    'evaluation_id' => $item['evaluation_id'],
                    'question_category_id' => $item['question_category_id'],
                ]);
            }
            
        }
        // $this->call("OthersTableSeeder");
    }
}
