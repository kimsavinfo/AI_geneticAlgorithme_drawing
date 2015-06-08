using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

using System.Drawing.Imaging;
using IAGenetic_DrawingMuse.Genetic;

namespace IAGenetic_DrawingMuse
{
    public partial class Form1 : Form
    {
        private PopulationGenetic muse;
        private Bitmap imgGoal;

        public Form1()
        {
            InitializeComponent();

            // Create a Bitmap object from an image file.
            imgGoal = new Bitmap(Properties.Resources.joconde);
            pictureBoxGoal.Image = imgGoal;
        }

        private void buttonInitialization_Click(object sender, EventArgs e)
        {
            PopulationGoal goal = new PopulationGoal(imgGoal);
            muse = new PopulationGenetic(goal);

            Bitmap imgGenetic = new Bitmap(muse.GetWitdh(), muse.GetHeight());
            IndividualColor[] individuals = muse.GetIndividuals();
            int iPixel = 0;
            int iLine, iColumn;
            foreach (IndividualColor pixel in individuals)
            {
                iLine = (int)Math.Floor((double)(iPixel / muse.GetWitdh()));
                iColumn = iPixel - iLine * muse.GetWitdh();
                imgGenetic.SetPixel(iColumn, iLine, pixel.GetColor());

                iPixel++;
            }
            pictureBoxGenetic.Image = imgGenetic;
        }
    }
}
